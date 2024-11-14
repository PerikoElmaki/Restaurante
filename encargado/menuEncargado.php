<?php
include "../sesion.php";
include "../conexion.php";
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
        <div class="centrar">
            <h2>Menú Encargado</h2>
            <!-- Saludar camarero -->
            <?php
            $nombre = $_SESSION['nombre'];
            echo "<h3>Bienvenido, $nombre</h3>";
            ?>
        </div>
    </nav>
    <section class="container">
        <div class="row">
            <a href="listadoCamareros.php">
                <h3>Listado de los camareros</h3>
            </a>
            <a href="formAñadirCamarero.php">
                <h3>Añadir camareros</h3>
            </a>
            <a href="../camarero/menuCamarero.php">
                <h3>Vista de Camarero</h3>
            </a>
        </div>
        <!-- Productos -->
        <h4>Gestión de productos</h4>
        <div class="row">
            <a href="ListadoProductos.php">
                <h3>Listado de productos</h3>
            </a>
            <a href="formAñadirProductos.php">
                <h3>Añadir productos</h3>
            </a>
        </div>

    </section>
</body>

</html>