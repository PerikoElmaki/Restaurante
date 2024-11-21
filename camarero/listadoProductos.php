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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav>
        <div class="volver">
            <h4><a href="menuCamarero.php">
                    <=Volver al menu
                        </a>
            </h4>
        </div>
        <div class="centrar">
            <h3 class="roboTitle">Menu Camareros</h3>
            <!-- Saludar camarero -->
            <?php
            $nombre = $_SESSION['nombre'];
            echo "<h5 class='roboTitle mt-1'>Bienvenido, $nombre</h5>";
            ?>
        </div>
    </nav>
    <section>
        <div>
            <h3>Listado de Productos</h3>
        </div>
        <div class="container">
            <div class="row justify-content-start">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio </th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT * FROM productos";

                        $resultado = mysqli_query($conn, $consulta);

                        while ($fila = mysqli_fetch_array($resultado)) {
                            $id = $fila['id'];
                            $nombre = $fila['nombre'];
                            $categ = $fila['categoria'];
                            $precio = $fila['precio'];
                            $stock = $fila['stock'];

                            // Ponemos clase a row según categoría
                            switch ($categ) {
                                case 'bebidas':
                                    $clase = "table-primary";
                                    break;
                                case 'Postre':
                                    $clase = "table-secondary";
                                    break;
                                case 'Entrante':
                                    $clase = "table-light";
                                    break;
                                case 'Ensalada':
                                    $clase = "table-success";
                                    break;
                                case 'Pasta':
                                    $clase = "table-danger";
                                    break;
                                case 'Pizza':
                                    $clase = "table-info";
                                    break;
                            }


                            echo "<tr class='$clase'>";
                            echo "<td class='tdProductos'>$nombre</td>";
                            echo "<td class='tdProductos'>$categ</td>";
                            echo "<td class='tdProductos'>$precio $</td>";
                            echo "<td class='tdProductos'>$stock unidades</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</body>

</html>