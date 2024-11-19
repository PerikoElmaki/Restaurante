<?php
include "sesionEncargado.php";
include "../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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
            <a href="../logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-in-left"></i></a>
        </div>
        <div class="centrar">
            <h3 class="roboTitle">Menú Encargado</h3>
            <!-- Saludar camarero -->
            <?php
            $nombre = $_SESSION['nombre'];
            echo "<h5 class='roboTitle'>Bienvenido, $nombre</h5>";
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