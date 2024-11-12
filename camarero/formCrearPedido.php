<?php
include "../conexion.php";
include "../sesion.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
            $id = $_GET['id'];
            echo "<h1>Mesa $id</h1>";
            $nombre = $_SESSION['nombre'];
            echo "<h3>Camarero: $nombre</h3>";
            ?>
        </div>
    </nav>
    <section>
        <div class="container">
            <h2>Realiza tu Pedido</h2>
            <form action="crearPedido.php" method="post" class="listadoProd" >
                <?php
                $consulta = "SELECT * FROM productos";

                $resultado = mysqli_query($conn, $consulta);

                while ($fila = mysqli_fetch_array($resultado)) {

                    $id = $fila['id'];
                    $nombre = $fila['nombre'];
                    $categ = $fila['categoria'];
                    $precio = $fila['precio'];
                    $stock= $fila['stock'];
                
                    echo "<div class='col-12 productosCaja'>";
                    echo "<h5 class='productosItem' name='id' value='$id'>$id</h5>";
                    echo "<h4 class='productosItem' name='nombre'>$nombre</h4>";
                    echo "<h5 class='productosItem' name='categ'>$categ</h5>";
                    echo "<h5 class='productosItem' name='precio'>$precio $</h5>";
                    $idcoment = $id. "coment";
                    echo "<input type='text' id='$idcoment' name='$idcoment'>";
                    // echo "<h5 class='productosItem' name='stock'>$stock u</h5>";
                    // Crear id para chekbox, será el id del producto mas check
                    $idcheck = $id. "check";
                    echo "<input type='checkbox' id='$idcheck' name='$idcheck' class='productosItem'>";
                    echo"$idcheck";
                    echo "</div>";
                    

                }
                ?>

                <input type="submit" class="btn btn-primary" > 
            </form> 

        </div>
    </section>
</body>

</html>