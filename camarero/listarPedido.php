<?php
include "../sesion.php";
include "../conexion.php";

$mesaId = isset($_GET['mesaId']) ? $_GET['mesaId'] : null;
if ($mesaId === null) {
    die("Error: id de mesa no especificado.");
}

// Obtener el ID del pedido asociado a la mesa
$consultaPedido = "SELECT id FROM pedidos WHERE mesa = '$mesaId'"; // Asegúrate de que el estado del pedido es 0 (activo)
$resultadoPedido = mysqli_query($conn, $consultaPedido);
if ($resultadoPedido && mysqli_num_rows($resultadoPedido) > 0) {
    $filaPedido = mysqli_fetch_assoc($resultadoPedido);
    $pedidoId = $filaPedido['id'];
} else {
    die("Error: No se encontró un pedido activo para esta mesa.");
}

// Obtener los artículos del pedido desde lineas_pedidos utilizando una subconsulta para obtener el nombre del producto y el precio
$consultaLineas = "
    SELECT lp.*, 
           (SELECT p.nombre FROM productos p WHERE p.id = lp.producto) AS nombre,
           (SELECT p.precio FROM productos p WHERE p.id = lp.producto) AS precio
    FROM lineas_pedidos lp 
    WHERE lp.pedido = '$pedidoId'";
$resultadoLineas = mysqli_query($conn, $consultaLineas);

// Obtener el precio de los productos y guardarlos en un array
$preciosProductos = [];
$consultaPrecios = "SELECT id, precio FROM productos";
$resultadoPrecios = mysqli_query($conn, $consultaPrecios);
if ($resultadoPrecios && mysqli_num_rows($resultadoPrecios) > 0) {
    while ($filaPrecio = mysqli_fetch_assoc($resultadoPrecios)) {
        $preciosProductos[$filaPrecio['id']] = $filaPrecio['precio'];
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Pedido</title>
    <link rel="stylesheet" href="stylesPedido.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="volver">
            <a href="salon.php" class="btn btn-primary"><i class="bi bi-arrow-return-left"></i></a>
        </div>
        <div class="centrar">
            <?php
            $mesaId = $_GET['mesaId'];
            echo "<h1>Mesa $mesaId</h1>";
            $nombre = $_SESSION['nombre'];
            echo "<h3>Camarero: $nombre</h3>";
            ?>
        </div>
    </nav>
    <div class="container mt-4">
        <section>
            <div class="container">
                <h2>Artículos del Pedido <?php echo "$pedidoId"; ?></h2>
                <?php

                if ($resultadoLineas && mysqli_num_rows($resultadoLineas) > 0) {
                    echo "<table class='table table-striped'>";
                    echo "<thead><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Comentario</th></tr></thead>";
                    echo "<tbody>";
                    while ($filaLinea = mysqli_fetch_assoc($resultadoLineas)) {
                        $nombreProducto = $filaLinea['nombre'];
                        $cantidad = $filaLinea['cant'];
                        $comentario = $filaLinea['comentario'];
                        $precio = $filaLinea['precio'];

                        echo "<tr>";
                        echo "<td>$nombreProducto</td>";
                        echo "<td>$cantidad</td>";
                        echo "<td>$precio</td>";
                        echo "<td>$comentario</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>No hay artículos en este pedido.</p>";
                }
                ?>
            </div>
        </section>
        <br>
        <hr>
        <!-- Total y pagar -->
        <footer class="row justify-content-between">
            <?php
            // Obtener el total del pedido
            $consultaTotal = "SELECT total FROM pedidos WHERE id = '$pedidoId'";
            $resultadoTotal = mysqli_query($conn, $consultaTotal);
            if ($resultadoTotal && mysqli_num_rows($resultadoTotal) > 0) {
                $filaTotal = mysqli_fetch_assoc($resultadoTotal);
                $totalPedido = $filaTotal['total'];
                echo "<h2 class='col-5'>Total: $totalPedido $</h2>";
            } else {
                echo "<h2>Total: No disponible</h2>";
            }
            ?>
            <div class="col-5">
                <div class="btn-group">
                    <form id="ticketForm" action="ticketCliente.php" method="post">
                        <?php
                        // enviamos datos a crearTicket
                        mysqli_data_seek($resultadoLineas, 0); // Reset the result pointer to the beginning
                        while ($filaLinea = mysqli_fetch_assoc($resultadoLineas)) {
                            $nombreProducto = $filaLinea['nombre'];
                            $cantidad = $filaLinea['cant'];
                            $comentario = $filaLinea['comentario'];
                            $precio = $filaLinea['precio'];
                            echo "<input type='hidden' name='productos[]' value='$nombreProducto'>";
                            echo "<input type='hidden' name='cantidades[]' value='$cantidad'>";
                            echo "<input type='hidden' name='comentarios[]' value='$comentario'>";
                            echo "<input type='hidden' name='precios[]' value='$precio'>";
                        }
                        ?>
                        <input type="hidden" name="mesaId" value="<?php echo $mesaId; ?>">
                        <input type="hidden" name="pedidoId" value="<?php echo $pedidoId; ?>">
                        <input type="hidden" name="totalPedido" value="<?php echo $totalPedido; ?>">
                        <button type="submit" class="btn btn-outline-dark">Ticket</button>
                    </form>
                    <!-- El de pagar va a abrir un modal -->
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal">Pagar</button>
                </div>
            </div>
            <!-- modal para confirmar que vas a pagar -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmar pago</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Confirma que han pagado los <b><?php echo "$totalPedido"; ?></b> euros y que no faltan perras.
                            <p>Luego el jefe se enfada....</p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <form id="pagarForm" action="pagarPedido.php" method="post">
                                <!-- Nos llevamos el id de la mesa y el id del pedido para hacer el update -->

                                <input type="hidden" name="mesaId" value="<?php echo $mesaId; ?>">
                                <input type="hidden" name="pedidoId" value="<?php echo $pedidoId; ?>">
                                <input type="submit" class="btn btn-success" value="Confirmar y pagar">
                            </form>
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>

                    </div>
                </div>
            </div>


        </footer>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
mysqli_close($conn);
?>