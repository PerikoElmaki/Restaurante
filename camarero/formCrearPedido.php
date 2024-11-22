<?php
include "../sesion.php";
include "../conexion.php";

$mesaId = isset($_GET['mesaId']) ? $_GET['mesaId'] : null;
if ($mesaId === null) {
    die("Error: id de mesa no especificado.");
}

// Funciones de los formularios
// Insecion en carrito

// Funciones de los formularios
// Inserción en carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['productosSeleccionados'])) {
        $productosSeleccionados = $_POST['productosSeleccionados'];
        foreach ($productosSeleccionados as $idProducto) {
            $insertQuery = "INSERT INTO lineas_carrito (producto) VALUES ('$idProducto')";
            mysqli_query($conn, $insertQuery);
        }
        // Redirigir para evitar duplicación de datos al recargar
        header("Location: formCrearPedido.php?mesaId=$mesaId");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Latest compiled and minified CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>


    <style>
        body {
            background-color: rgb(244, 244, 244);
        }



        .title {
            text-align: center;
        }

        .cont {
            background-color: rgb(15, 15, 15);
            border-radius: 7px;
            padding: 20px;
        }

        .categ {
            background-color: aliceblue;
            padding: 20px;
            border-radius: 5px;
            margin-right: auto;
            margin-left: auto;
        }

        .botones {
            width: 100%;
            height: 100%;
            align-content: center;
        }
    </style>

</head>

<body>
    <nav>
        <div class="volver">
            <a href="salon.php" class="btn btn-primary"><i class="bi bi-arrow-return-left"></i></a>
        </div>
        <div class="centrar">
            <?php
            $mesaId = $_GET['mesaId'];
            echo "<h1>Mesa $mesaId</h1>";
            $nombre = $_SESSION['nombre'];
            echo "<h3>Camarero: $nombre</h3>";
            ?>
        </div>
    </nav>


    <div class="container">
        <div class="title">
            <h2 class="col-12 mt-4">Realiza tu Pedido</h2>
        </div>

        <form action="" method="post">
            <input type="hidden" name="mesaId" value="<?php echo $mesaId; ?>">
            <!-- contenedor -->
            <div class="row justify-content-center">
                <div class="cont g-3">
                    <!-- header con botones link -->
                    <div class="accordion" id="accordionExample">
                        <?php
                        $consulta = "SELECT * FROM productos";
                        $resultado = mysqli_query($conn, $consulta);
                        $categorias = [
                            'bebidas' => 'Bebidas',
                            'Entrante' => 'Entrantes',
                            'Ensalada' => 'Ensaladas',
                            'Pasta' => 'Pastas',
                            'Pizza' => 'Pizzas',
                            'Postre' => 'Postres'
                        ];
                        foreach ($categorias as $categoria => $categoriaNombre) {
                            echo "<div class='accordion-item'>";
                            echo "<h2 class='accordion-header' id='heading$categoria'>";
                            echo "<button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$categoria' aria-expanded='true' aria-controls='collapse$categoria'>";
                            echo "$categoriaNombre";
                            echo "</button>";
                            echo "</h2>";
                            echo "<div id='collapse$categoria' class='accordion-collapse collapse' aria-labelledby='heading$categoria' data-bs-parent='#accordionExample'>";
                            echo "<div class='accordion-body'>";
                            echo "<div class='row justify-content-center'>";
                            while ($fila = mysqli_fetch_array($resultado)) {
                                if ($fila['categoria'] == $categoria) {
                                    $id = $fila['id'];
                                    $nombre = $fila['nombre'];
                                    $precio = $fila['precio'];
                                    $stock = $fila['stock'];

                                    // Ponemos clase a row según categoría
                                    switch ($categoria) {
                                        case 'bebidas':
                                            $clase = "btn btn-outline-primary";
                                            break;
                                        case 'Postre':
                                            $clase = "btn btn-outline-secondary";
                                            break;
                                        case 'Entrante':
                                            $clase = "btn btn-outline-dark ";
                                            break;
                                        case 'Ensalada':
                                            $clase = "btn btn-outline-success";
                                            break;
                                        case 'Pasta':
                                            $clase = "btn btn-outline-danger";
                                            break;
                                        case 'Pizza':
                                            $clase = "btn btn-outline-info";
                                            break;
                                    }

                                    echo "<div class='d-grid col-6 col-sm-6 col-md-4 col-lg-3 mb-1'>";
                                    echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                    echo "<label for='$nombre' class='$clase'>$nombre</label>";
                                    echo "</div>";
                                }
                            }
                            // Reset the result pointer to the beginning
                            mysqli_data_seek($resultado, 0);
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-3 ">
                    <input type="submit" class="col-7 mt-3 btn btn-success" value="Añadir al carrito">
                </div>
            </div>
        </form>

        <div class="row justify-content-center">
            <h2 class="g-3 ms-4 mb-4">Productos seleccionados</h2>


            <form action="crearPedido.php" id="enviarPedido" method="post">
                <input type="hidden" name="mesaId" value="<?php echo $mesaId; ?>">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Comentario</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Perform a SELECT query to fetch the inserted data
                        $selectQuery = "SELECT * FROM lineas_carrito";
                        $result = mysqli_query($conn, $selectQuery);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $idProductoCarrito = $row['producto'];
                            // Para mostrar nombre producto 
                            $consultaProducto = "SELECT nombre FROM productos WHERE id = $idProductoCarrito";
                            $resultadoProducto = mysqli_query($conn, $consultaProducto);
                            if ($filaProducto = mysqli_fetch_assoc($resultadoProducto)) {
                                $nombreProducto = $filaProducto['nombre'];

                                // Creamos formulario
                                echo "<tr>";
                                echo "<td>$nombreProducto</td>";
                                // era para ticket
                                echo "<input type='hidden' name='nombresProductos[]' value='$nombreProducto'>";
                                echo "<input type='hidden' name='productosSeleccionados[]' value='$idProductoCarrito'>";
                                echo "<td><div class='input-group'>";
                                echo "<button type='button' class='btn btn-warning' onclick='decrementQuantity(this)'>-</button>";
                                echo "<input type='text' class='form-control' name='cantidades[$idProductoCarrito]' placeholder='Cantidad' value='1'>";
                                echo "<button type='button' class='btn btn-primary' onclick='incrementQuantity(this)'>+</button>";
                                echo "</div></td>";
                                echo "<td><input type='text' class='form-control' name='comentarios[$idProductoCarrito]' placeholder='Comentario'></td>";
                                echo "<td><form action='eliminarProducto.php' method='post'><input type='hidden' name='mesaId' value='$mesaId'><input type='hidden' name='eliminarProducto' value='$idProductoCarrito'><input type='submit' class='btn btn-danger' value='Eliminar'></form></td>";
                                echo "</tr>";
                            }
                        }


                        ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mb-3 ">
                    <input type="submit" class="col-7 mt-3 btn btn-primary" value="Enviar pedido ">
                </div>
            </form>
        </div>
    </div>


    </div>
    <script>
        function incrementQuantity(button) {
            var input = button.previousElementSibling;
            input.value = parseInt(input.value) + 1;
        }

        function decrementQuantity(button) {
            var input = button.nextElementSibling;
            input.value = parseInt(input.value) - 1;
            if(input.value < 1){
                input.value = 1;
            }
        }
    </script>
</body>

</html>