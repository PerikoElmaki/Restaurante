<?php
include "../sesion.php";
include "../conexion.php";

$mesaId = isset($_GET['id']) ? $_GET['id'] : null;
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

// Obtener los artículos del pedido desde lineas_pedidos utilizando una subconsulta para obtener el nombre del producto
$consultaLineas = "
    SELECT lp.*, 
           (SELECT p.nombre FROM productos p WHERE p.id = lp.producto) AS nombre 
    FROM lineas_pedidos lp 
    WHERE lp.pedido = '$pedidoId'";
$resultadoLineas = mysqli_query($conn, $consultaLineas);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Pedido</title>
    <link rel="stylesheet" href="stylesPedido.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="volver">
            <h4><a href="salon.php">
                    <=Volver al salón
                        </a>
            </h4>
        </div>
        <div class="centrar">
            <?php
            $idmesa = $_GET['id'];
            echo "<h1>Mesa $idmesa</h1>";
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
                    // Debugging: Ver el contenido de $resultadoLineas
                    echo "<pre>";
                    var_dump($resultadoLineas);
                    echo "</pre>";
                if ($resultadoLineas && mysqli_num_rows($resultadoLineas) > 0) {
                    echo "<table class='table table-striped'>";
                    echo "<thead><tr><th>Producto</th><th>Cantidad</th><th>Comentario</th></tr></thead>";
                    echo "<tbody>";
                    while ($filaLinea = mysqli_fetch_assoc($resultadoLineas)) {
                        $nombreProducto = $filaLinea['nombre'];
                        $cantidad = $filaLinea['cant'];
                        $comentario = $filaLinea['comentario'];
                        echo "<tr>";
                        echo "<td>$nombreProducto</td>";
                        echo "<td>$cantidad</td>";
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
mysqli_close($conn);
?>