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
            <h3>Listado de Productos</h3>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio </th>
                <th>Stock</th>
            </tr>
            <?php
            $consulta = "SELECT * FROM productos";

            $resultado = mysqli_query($conn, $consulta);

            while ($fila = mysqli_fetch_array($resultado)) {
                $id = $fila['id'];
                $nombre = $fila['nombre'];
                $categ = $fila['categoria'];
                $precio = $fila['precio'];
                $stock = $fila['stock'];

                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$nombre</td>";
                echo "<td>$categ</td>";
                echo "<td>$precio $</td>";
                echo "<td>$stock unidades</td>";
                echo "</tr>";
            }
            ?>
        </table>

    </section>
</body>

</html>