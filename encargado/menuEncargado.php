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
</head>

<body>
    <nav>
        <h1>Menu Encargado</h1>
        <!-- Saludar camarero -->
        <?php
        $nombre = $_SESSION['nombre'];
        echo "<h3>Bienvenido, $nombre</h3>";
        ?>
    </nav>
    <section>
        <div>
            <a href="formListadoCamareros.php">
                <h3>Listado de los camareros</h3>
            </a>
        </div>

        <div>
            <a href="formAñadirCamarero.php">
                <h3>Añadir camareros</h3>
            </a>
        </div>

    </section>
</body>

</html>