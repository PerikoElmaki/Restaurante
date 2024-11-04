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
        <h1>Encargado</h1>
        <!-- Saludar camarero -->
        <?php
        $nombre = $_SESSION['nombre'];
        echo "<h3>$nombre</h3>";
        ?>
    </nav>
    <section>
        <div class="listadoUsuarios">
            
        </div>
    </section>
</body>

</html>