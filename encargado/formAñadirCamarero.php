<?php
include "../sesion.php";
include "../conexion.php";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav>
        <h1>Menu Encargado</h1>
        <?php
        $nombre = $_SESSION['nombre'];
        echo "<h3>$nombre</h3>";
        ?>
    </nav>
    <div class="container">
        <h3>Añadir camarero</h3>
        <form action="añadirCamarero.php" method="post" class="row">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del camarero" required>
            <input type="password" name="contraseña" id="contraseña"  placeholder="Contraseña" required>
            <div class="w-100"></div>
            <input type="text" name="dni" id="dni" placeholder="DNI" required>
            <input type="file" name="foto" id="foto"  placeholder="foto" required>
            <input type="checkbox" name="encargado" id="encargado" value="0">
            <label for="encargado">¿Es encargado?</label>
            <input type="submit">
        </form>
    </div>
</body>

</html>