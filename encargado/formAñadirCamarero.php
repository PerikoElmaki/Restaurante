<?php
    include "../sesion.php";
    include "../conexion.php";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="formAñadirCamarero">
        <form action="añadirCamarero.php" method="post">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del camarero" required>
            <input type="text" name="contraseña" id="contraseña" placeholder="Contraseña" required>
            <input type="text" name="dni" id="dni" placeholder="DNI" required>
            <input type="file" name="foto" id="foto" placeholder="foto" required>
            <input type="checkbox" name="encargado" id="encargado" value="1">
            <label for="encargado">¿Es encargado?</label>
        </form>
    </div>
</body>

</html>