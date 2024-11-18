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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .cont {
            background-color: black;
            border-radius: 15px;
        }
    </style>
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
            <form action="" method="post">
                <!-- contenedor -->
                <div class="row justify-content-center">
                    <div class="cont row g-5">
                        <!-- header con botones link -->
                        <div class="col-12">
                            <div class="btn-group">
                                <a href="#bebidas" class="btn btn-primary">Bebidas</a>
                                <a href="#entrantes" class="btn btn-warning">Entrantes</a>
                            </div>
                        </div>

                        <?php
                        $consulta = "SELECT * FROM productos";

                        $resultado = mysqli_query($conn, $consulta);

                        while ($fila = mysqli_fetch_array($resultado)) {

                            $id = $fila['id'];
                            $nombre = $fila['nombre'];
                            $categ = $fila['categoria'];
                            $precio = $fila['precio'];
                            $stock = $fila['stock'];

                            $finBebida =false;
                            // $flagEntrante = false;
                            if($finBebida == false){
                                
                            }
                            if ($categ == 'bebidas') {
                                echo "<div class='col-4 col-md-3 col-lg-2 mb-1'>";
                                echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                echo "<label for='$nombre' class='btn btn-outline-primary'>$nombre</label>";
                                echo "</div>";
                            }

                            if ($categ == 'Entrante') {

                                echo "<div class='col-4 col-md-3 col-lg-2 mb-1'>";
                                echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                echo "<label for='$nombre' class='btn btn-outline-light'>$nombre</label>";
                                echo "</div>";
                            }
                            if ($categ == 'Ensalada') {

                                echo "<div class='col-4 col-md-3 col-lg-2 mb-1'>";
                                echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                echo "<label for='$nombre' class='btn btn-outline-success'>$nombre</label>";
                                echo "</div>";
                            }
                            if ($categ == 'Pasta') {

                                echo "<div class='col-4 col-md-3 col-lg-2 mb-1'>";
                                echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                echo "<label for='$nombre' class='btn btn-outline-warning'>$nombre</label>";
                                echo "</div>";
                            }
                            if ($categ == 'Pizza') {

                                echo "<div class='col-4 col-md-3 col-lg-2 mb-1'>";
                                echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                echo "<label for='$nombre' class='btn btn-outline-danger'>$nombre</label>";
                                echo "</div>";
                            }
                            if ($categ == 'Postre') {

                                echo "<div class='col-4 col-md-3 col-lg-2 mb-1'>";
                                echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                echo "<label for='$nombre' class='btn btn-outline-info'>$nombre</label>";
                                echo "</div>";
                            }

                            echo "<input type='hidden' name='nombresProductos[$id]' value='$nombre'>";
                        }

                        ?>
                        <input type="submit" class="btn btn-success" value="Añadir al carrito">
                    </div>
                </div>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productosSeleccionados'])) {
                $productosSeleccionados = $_POST['productosSeleccionados'];
                foreach ($productosSeleccionados as $idProducto) {
                    $insertQuery = "INSERT INTO lineas_carrito (producto) VALUES ('$idProducto')";
                    mysqli_query($conn, $insertQuery);
                }
            }
            ?>


            <div class="container">
                <h2>Productos seleccionados</h2>
                <form action="crearPedido.php" method="post" class="listadoProd">
                    <input type="hidden" name="mesaId" value="<?php echo $mesaId; ?>">
                    <?php
                    // Perform a SELECT query to fetch the inserted data
                    $selectQuery = "SELECT * FROM lineas_carrito";
                    $result = mysqli_query($conn, $selectQuery);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $idProductoCarrito = $row['producto'];
                        // Para mostrar nombre producto 
                        $consultaProducto = "SELECT nombre FROM productos WHERE id = $idProductoCarrito";
                        $resultadoProducto = mysqli_query($conn, $consultaProducto);
                        if ($filaProducto = mysqli_fetch_assoc($resultadoProducto)) {
                            $nombreProducto = $filaProducto['nombre'];

                            // Creamos formulario
                            echo "<div class='col-12 productosCaja'>";
                            echo "<p class='productosItem'>$nombreProducto</p><br>";
                            echo "<input type='hidden' name='productosSeleccionados[]' value='$idProductoCarrito'>";
                            echo "<input type='number' class='productosItem' name='cantidades[$idProductoCarrito]' placeholder='Cantidad' value='1'>";
                            echo "<input type='text' class='productosItem' name='comentarios[$idProductoCarrito]' placeholder='Comentario'>";
                            echo "</div>";
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