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
            <a href="2menuEncargado.php" class="btn btn-primary"><i class="bi bi-arrow-return-left"></i></a>
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
        <section>
            <div class="row justify-content-start">
                <h3 class="col-8">Listado de Productos</h3>
                <form action="listadoProductos.php" method="post" class="col-2">
                    <button type="submit" name="update_stock" class="btn btn-warning">Restablecer stock</button>
                </form>
                <?php
                if (isset($_POST['update_stock'])) {
                    // Actualizar el stock de todos los productos a 100
                    $updateQuery = "UPDATE productos SET stock = 100";
                    if (mysqli_query($conn, $updateQuery)) {
                        echo "<div class='alert alert-success'>Stock actualizado a 100 para todos los productos.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error al actualizar el stock: " . mysqli_error($conn) . "</div>";
                    }
                }
                ?>
            </div>
            <div class="container">
                <div class="row">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th class="text-start">Nombre</th>
                                <th class="text-start">Categoría</th>
                                <th class="text-start">Precio </th>
                                <th class="text-start">Stock</th>
                               
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
                                $clase = "";
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


                                echo "<tr class='$clase col-12'>";
                                echo "<td class='tdProductos'>$nombre</td>";
                                echo "<td class='tdProductos'>$categ</td>";
                                echo "<td class='tdProductos'>$precio $</td>";
                                echo "<td class='tdProductos'>$stock U <a href='eliminarProducto.php?id=$id' class='ms-3 btn btn-danger'><i class='bi bi-trash'></i></a></td>";
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