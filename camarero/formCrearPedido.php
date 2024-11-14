<?php
include "../sesion.php";
include "../conexion.php";

$mesaId = isset($_GET['id']) ? $_GET['id'] : null;
if ($mesaId === null) {
    die("Error: id de mesa no especificado.");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav>
        <div class="volver">
            <a href="salon.php" class="btn btn-primary"><i class="bi bi-arrow-return-left"></i></a>
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
    <section>
        <div class="container">
            <h2>Realiza tu Pedido</h2>
            <form action="" method="post" class="listadoProd">
                <?php
                $consulta = "SELECT * FROM productos";

                $resultado = mysqli_query($conn, $consulta);

                while ($fila = mysqli_fetch_array($resultado)) {

                    $id = $fila['id'];
                    $nombre = $fila['nombre'];
                    $categ = $fila['categoria'];
                    $precio = $fila['precio'];
                    $stock = $fila['stock'];


                    echo "<div class='col-12 productosCaja'>";
                    echo "<h5 class='productosItem' name='id' value='$id'>$id</h5>";
                    echo "<h4 class='productosItem' name='nombre'>$nombre</h4>";
                    echo "<h5 class='productosItem' name='categ'>$categ</h5>";
                    echo "<h5 class='productosItem' name='precio'>$precio $</h5>";

                    echo "<input type='hidden' name='nombresProductos[$id]' value='$nombre'>";
                    echo "<input type='checkbox' name='productosSeleccionados[]' value='$id'>";

                    echo "</div>";
                }
                ?>
                <input type="submit" class="btn btn-success" value="Añadir al carrito">
            </form>

            <div class="container">
                <h2>Productos seleccionados</h2>
                <form action="crearPedido.php" method="post" class="listadoProd">
                    <input type="hidden" name="mesaId" value="<?php echo $mesaId; ?>">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Verificar si se han seleccionado productos
                        if (isset($_POST['productosSeleccionados'])) {
                            $productosSeleccionados = $_POST['productosSeleccionados']; // Este es el array con los IDs seleccionados
                            $nombresProductos = $_POST['nombresProductos'];
                            foreach ($productosSeleccionados as $idProducto) {
                                $nombreProducto = $nombresProductos[$idProducto];

                                echo "<div class='col-12 productosCaja'>";
                                echo "<p class='productosItem'>$nombreProducto</p><br>";
                                echo "<input type='hidden' name='productosSeleccionados[]' value='$idProducto'>";
                                echo "<input type='number' class='productosItem' name='cantidades[$idProducto]' placeholder='Cantidad' value='1'>";
                                echo "<input type='text' class='productosItem' name='comentarios[$idProducto]' placeholder='Comentario'>";
                                echo "</div>";
                            }
                        }
                    }
                    ?>
                    <input type="submit" class="btn btn-primary" value="Enviar pedido">
                </form>

            </div>
        </div>
    </section>
</body>

</html>