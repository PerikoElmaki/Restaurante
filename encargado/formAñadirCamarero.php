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
        <div class="volver">
            <h4><a href="menuEncargado.php">
                    <=Volver al menu
                        </a>
            </h4>
        </div>
        <div class="centrar">
            <h2>Encargado</h2>
            <!-- Saludar camarero -->
            <?php
            $nombre = $_SESSION['nombre'];
            echo "<h3>$nombre</h3>";
            ?>
        </div>
    </nav>
    <section>
        <div>
            <h3>Añadir camarero</h3>
            <form action="añadirCamarero.php" method="post">
                <input type="text" name="nombre" id="nombre" placeholder="Nombre del camarero" required>
                <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña" required>
                <input type="text" name="dni" id="dni" placeholder="DNI" required>
                <input type="file" name="foto" id="foto" placeholder="foto" required>
                <input type="checkbox" name="encargado" id="encargado" value="0">
                <label for="encargado">¿Es encargado?</label>
                <input type="submit">
            </form>
        </div>
    </section>
</body>

</html>