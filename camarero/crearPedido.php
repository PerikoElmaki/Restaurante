<?php
include "../sesion.php";
include "../conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mesaId']) && isset($_POST['productosSeleccionados']) && isset($_POST['cantidades']) && isset($_POST['comentarios'])) {
        $mesaId = $_POST['mesaId'];
        $productosSeleccionados = $_POST['productosSeleccionados'];
        $cantidades = $_POST['cantidades'];
        $comentarios = $_POST['comentarios'];

        // Crear el pedido en la base de datos
        $camareroId = $_SESSION['id'];
        $sqlPedido = "INSERT INTO pedidos (mesa, camarero, total) VALUES ('$mesaId', '$camareroId', 0)";
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

            header("LOCATION:menuCamarero.php");
        } else {
            echo "Error: " . $sqlPedido . "<br>" . $conn->error;
        }
    } else {
        echo "No se han recibido productos seleccionados, cantidades o comentarios.";
    }
}

mysqli_close($conn);
?>