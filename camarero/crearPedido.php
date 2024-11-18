<?php
include "../sesion.php";
include "../conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mesaId']) && isset($_POST['productosSeleccionados']) && isset($_POST['cantidades']) && isset($_POST['comentarios'])) {
        $mesaId = $_POST['mesaId'];
        $productosSeleccionados = $_POST['productosSeleccionados'];
        $cantidades = $_POST['cantidades'];
        $comentarios = $_POST['comentarios'];

        $total = 0.0;

        // Calcular el total del pedido
        foreach ($productosSeleccionados as $idProducto) {
            $cantidad = $cantidades[$idProducto];
            $consultaPrecio = "SELECT precio FROM productos WHERE id = '$idProducto'";
            $resultadoPrecio = mysqli_query($conn, $consultaPrecio);
            if ($resultadoPrecio && mysqli_num_rows($resultadoPrecio) > 0) {
                $filaPrecio = mysqli_fetch_assoc($resultadoPrecio);
                $precio = $filaPrecio['precio'];
                $total += $precio * $cantidad;
            }
        }
        
        // Crear el pedido en la base de datos
        $sqlPedido = "INSERT INTO pedidos (mesa,total,pagado) VALUES ('$mesaId', '$total', 0)";
        if ($conn->query($sqlPedido) === TRUE) {
            $pedidoId = $conn->insert_id; // Obtener el ID del pedido recién creado

            // Insertar las líneas del pedido
            foreach ($productosSeleccionados as $idProducto) {
                $cantidad = $cantidades[$idProducto];
                $comentario = $comentarios[$idProducto];
                $sqlLineaPedido = "INSERT INTO lineas_pedidos (pedido, producto, cant, comentario) VALUES ('$pedidoId', '$idProducto', '$cantidad', '$comentario')";
                if (!$conn->query($sqlLineaPedido)) {
                    echo "Error: " . $sqlLineaPedido . "<br>" . $conn->error;
                }
            }

            // Actualizar el estado de la mesa a 1 (ocupada)
            $sqlActualizarMesa = "UPDATE mesas SET estado = 1 WHERE codigo = '$mesaId'";
            if (!$conn->query($sqlActualizarMesa)) {
                echo "Error al actualizar el estado de la mesa: " . $sqlActualizarMesa . "<br>" . $conn->error;
            }

            header("LOCATION:salon.php");
        } else {
            echo "Error: " . $sqlPedido . "<br>" . $conn->error;
        }
    } else {
        echo "No se han recibido productos seleccionados, cantidades o comentarios.";
    }
}

mysqli_close($conn);
?>