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
    <!-- Boostras -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Roboto&display=swap" rel="stylesheet">

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
            echo "<h3>Mesa $mesaId</h3>";
            $nombre = $_SESSION['nombre'];
            echo "<h5>Camarero: $nombre</h5>";
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
                <div class="cont row g-5">
                    <!-- header con botones link -->
                    <div class="row justify-content-center">
                        <div class="btn-group col-12 col-md-5 mb-2">
                            <a href="#bebidas" class="btn btn-primary">Bebidas</a>
                            <a href="#entrantes" class="btn btn-dark">Entrantes</a>
                            <a href="#ensaladas" class="btn btn-success">Ensaladas</a>
                        </div>
                        <div class="btn-group col-12 col-md-5 mb-2">
                            <a href="#pastas" class="btn btn-danger">Pastas</a>
                            <a href="#pizzas" class="btn btn-info">Pizzas</a>
                            <a href="#postres" class="btn btn-secondary">Postres</a>
                        </div>
                    </div>
                    <?php
                    $consulta = "SELECT * FROM productos";
                    $resultado = mysqli_query($conn, $consulta);
                    $categorias = [
                        'bebidas' => 'bebidas',
                        'Entrante' => 'entrantes',
                        'Ensalada' => 'ensaladas',
                        'Pasta' => 'pastas',
                        'Pizza' => 'pizzas',
                        'Postre' => 'postres'
                    ];
                    foreach ($categorias as $categoria => $clase) {
                        echo "<div class='categ col-12 col-md-5' id='$clase'>";
                        echo "<h3 class='col-12 mb-3'>" . ucfirst($clase) . "</h3>";
                        echo "<div class='row justify-content-center'>";
                        while ($fila = mysqli_fetch_array($resultado)) {
                            if ($fila['categoria'] == $categoria) {
                                $id = $fila['id'];
                                $nombre = $fila['nombre'];
                                $precio = $fila['precio'];
                                $stock = $fila['stock'];
                                // Para cambiarlo de color
                                $buttonClass = '';
                                switch ($clase) {
                                    case 'bebidas':
                                        $buttonClass = 'primary';
                                        break;
                                    case 'entrantes':
                                        $buttonClass = 'dark';
                                        break;
                                    case 'ensaladas':
                                        $buttonClass = 'success';
                                        break;
                                    case 'pastas':
                                        $buttonClass = 'danger';
                                        break;
                                    case 'pizzas':
                                        $buttonClass = 'info';
                                        break;
                                    case 'postres':
                                        $buttonClass = 'secondary';
                                        break;
                                }
                                echo "<div class='col-6 mb-1'>";
                                echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                echo "<label for='$nombre' class='botones btn btn-outline-$buttonClass'>$nombre</label>";
                                echo "</div>";
                            }
                        }
                        // Reset the result pointer to the beginning
                        echo "</div>";
                        mysqli_data_seek($resultado, 0);
                        echo "</div>";
                    }
                    ?>
                </div>
                <input type="submit" class="col-5 mt-2 btn btn-success" value="Añadir al carrito">
            </div>
        </form>

        <div class="row justify-content-center">
            <h2>Productos seleccionados</h2>


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
                                echo "<td><input type='number' class='form-control' name='cantidades[$idProductoCarrito]' placeholder='Cantidad' value='1'></td>";
                                echo "<td><input type='text' class='form-control' name='comentarios[$idProductoCarrito]' placeholder='Comentario'></td>";
                                echo "<td><form action='eliminarProducto.php' method='post'><input type='hidden' name='mesaId' value='$mesaId'><input type='hidden' name='eliminarProducto' value='$idProductoCarrito'><input type='submit' class='btn btn-danger' value='Eliminar'></form></td>";
                                echo "</tr>";
                            }
                        }


                        ?>
                    </tbody>
                </table>
                <input type="submit" class="d-grid col-8 btn btn-primary" value="Enviar pedido">
            </form>
        </div>
    </div>


    </div>
</body>

</html>