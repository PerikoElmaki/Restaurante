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