<?php
include "sesionEncargado.php";
include "../conexion.php";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <a href="menuEncargado.php" class="btn btn-primary"><i class="bi bi-arrow-return-left"></i></a>
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
            <h3>Añadir Producto</h3>
            <form action="añadirProductos.php" method="post">
                <input type="text" name="nombre" id="nombre" placeholder="Nombre del Producto" required>
                <select name="categoria" id="categoria">
                    <option value="pizzas" selected>Pizzas</option>
                    <option value="bocatas">Bocatas</option>
                    <option value="entrantes">Entrantes</option>
                </select>
                <input type="number" name="precio" id="precio" placeholder="Precio" required>
                <input type="number" name="stock" id="stock" placeholder="Stock" required>
                <input type="submit">
            </form>
        </div>
    </section>
</body>

</html>