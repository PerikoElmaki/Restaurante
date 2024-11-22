<?php
include "../sesion.php";
include "../conexion.php";

$mesaId = isset($_GET['mesaId']) ? $_GET['mesaId'] : null;
if ($mesaId === null) {
    die("Error: id de mesa no especificado.");
}


// Obtener el ID del pedido asociado a la mesa y la fecha
$consultaPedido = "SELECT id, fecha FROM pedidos WHERE mesa = '$mesaId'"; // Asegúrate de que el estado del pedido es 0 (activo)
$resultadoPedido = mysqli_query($conn, $consultaPedido);
if ($resultadoPedido && mysqli_num_rows($resultadoPedido) > 0) {
    $filaPedido = mysqli_fetch_assoc($resultadoPedido);
    $pedidoId = $filaPedido['id'];
    $fechaPedido = $filaPedido['fecha'];
} else {
    die("Error: No se encontró un pedido activo para esta mesa.");
}


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
    <link rel="stylesheet" href="../styles.css">
    <!-- Boostras -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="volver">
            <a href="salon.php" class="btn btn-primary"><i class="bi bi-arrow-return-left"></i></a>
        </div>
        <div class="centrar">
            <?php
            $mesaId = $_GET['mesaId'];
            echo "<h3>Mesa $mesaId</h3>";
            $nombre = $_SESSION['nombre'];
            echo "<h5>Camarero: $nombre</h5>";
            ?>
        </div>
    </nav>
    <div>
        <section>
            <div class="container">
                <div class="row justify-content-start mt-1 ">

                    <h2 class="col-9 mt-1">Artículos del Pedido : <?php echo date('H:i', strtotime($fechaPedido)); ?></h2>
                    <?php
                    echo "<a href='ticketCocina.php?pedidoId=$pedidoId&mesaId=$mesaId' class='col-3 col-md-2 btn btn-secondary'><i class='bi bi-printer'></i> <br>Ticket cocina</a>";
                    ?>
                </div>
                <?php

                if ($resultadoLineas && mysqli_num_rows($resultadoLineas) > 0) {
                    echo "<table class='table'>";
                    echo "<thead><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Comentario</th></tr></thead>";
                    echo "<tbody>";
                    while ($filaLinea = mysqli_fetch_assoc($resultadoLineas)) {
                        $nombreProducto = $filaLinea['nombre'];
                        $cantidad = $filaLinea['cant'];
                        $comentario = $filaLinea['comentario'];
                        $precio = $filaLinea['precio'];

                        $consultaCategoria = "SELECT categoria FROM productos WHERE nombre = '$nombreProducto'";
                        $resultadoCategoria = mysqli_query($conn, $consultaCategoria);
                        $categoria = '';
                        if ($resultadoCategoria && mysqli_num_rows($resultadoCategoria) > 0) {
                            $filaCategoria = mysqli_fetch_assoc($resultadoCategoria);
                            $categoria = $filaCategoria['categoria'];
                        }

                        // Ponemos clase a row según categoría
                        switch ($categoria) {
                            case 'bebidas':
                                $clase = "table-primary";
                                break;
                            case 'Postre':
                                $clase = "table-secondary";
                                break;
                            case 'Entrante':
                                $clase = "table-light";
                                break;
                            case 'Ensalada':
                                $clase = "table-success";
                                break;
                            case 'Pasta':
                                $clase = "table-danger";
                                break;
                            case 'Pizza':
                                $clase = "table-info";
                                break;
                        }


                        echo "<tr class='$clase'>";
                        echo "<td class='tdPedidos'>$nombreProducto</td>";
                        echo "<td class='tdPedidos'>$cantidad</td>";
                        echo "<td class='tdPedidos'>$precio</td>";
                        echo "<td class='tdPedidos'>$comentario</td>";
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
        <footer class="row justify-content-start">
            <?php
            // Obtener el total del pedido
            $consultaTotal = "SELECT total FROM pedidos WHERE id = '$pedidoId'";
            $resultadoTotal = mysqli_query($conn, $consultaTotal);
            if ($resultadoTotal && mysqli_num_rows($resultadoTotal) > 0) {
                $filaTotal = mysqli_fetch_assoc($resultadoTotal);
                $totalPedido = $filaTotal['total'];

                // Mostrar con impuestos 
                $impuestos = $totalPedido * 0.10;
                $totalConImpuestos = $totalPedido + $impuestos;

                echo "<h2 class='col-5 mt-2 ms-3'>Total: $totalConImpuestos $</h2>";
            } else {
                echo "<h2>Total: No disponible</h2>";
            }
            ?>
            <div class="col-6 ">
                <div class="row justify-content-start">
                    <form id="ticketForm" class="col-5" action="ticketCliente.php" method="post">
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
                        <button type="submit" class="btn btn-dark ms-5"><i class="bi bi-printer"></i><br> Imprimir cuenta</button>
                    </form>
                    <!-- El de pagar va a abrir un modal -->
                    <button class="col-4 col-md-4 offset-md-1 btn btn-warning ms-5" data-bs-toggle="modal" data-bs-target="#myModal">Tramitar pago</button>
                </div>
            </div>
            <!-- modal para confirmar que vas a pagar -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmar pago</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Confirma que han pagado los <b><?php echo "$totalConImpuestos"; ?></b> euros y que no faltan perras.
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