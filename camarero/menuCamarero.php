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
        <h1>Menu Camareros</h1>
        <!-- Saludar camarero -->
        <?php
        $nombre = $_SESSION['nombre'];
        echo "<h3>Bienvenido, $nombre</h3>";
        ?>
    </nav>
    <section>
    
    </section>
</body>

</html>