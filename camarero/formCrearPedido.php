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
                <div class="cont row g-3">
                    <!-- header con botones link -->
                    <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-bebidas-tab" data-bs-toggle="pill" data-bs-target="#pills-bebidas" type="button" role="tab" aria-controls="pills-bebidas" aria-selected="true">Bebidas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-entrantes-tab" data-bs-toggle="pill" data-bs-target="#pills-entrantes" type="button" role="tab" aria-controls="pills-entrantes" aria-selected="false">Entrantes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-ensaladas-tab" data-bs-toggle="pill" data-bs-target="#pills-ensaladas" type="button" role="tab" aria-controls="pills-ensaladas" aria-selected="false">Ensaladas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-pastas-tab" data-bs-toggle="pill" data-bs-target="#pills-pastas" type="button" role="tab" aria-controls="pills-pastas" aria-selected="false">Pastas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-postres-tab" data-bs-toggle="pill" data-bs-target="#pills-postres" type="button" role="tab" aria-controls="pills-postres" aria-selected="false">Postres</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-pizzas-tab" data-bs-toggle="pill" data-bs-target="#pills-pizzas" type="button" role="tab" aria-controls="pills-pizzas" aria-selected="false">Pizzas</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <?php
                        $consulta = "SELECT * FROM productos";
                        $resultado = mysqli_query($conn, $consulta);
                        $categorias = [
                            'bebidas' => 'pills-bebidas',
                            'Entrante' => 'pills-entrantes',
                            'Ensalada' => 'pills-ensaladas',
                            'Pasta' => 'pills-pastas',
                            'Pizza' => 'pills-pizzas',
                            'Postre' => 'pills-postres'
                        ];
                        foreach ($categorias as $categoria => $tabId) {
                            $activeClass = $tabId === 'pills-bebidas' ? 'show active' : '';
                            echo "<div class='tab-pane fade $activeClass' id='$tabId' role='tabpanel' aria-labelledby='$tabId-tab'>";
                            echo "<div class='row justify-content-center '>";
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
                                            $clase = "btn btn-outline-light";
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

                                    echo "<div class='d-grid col-md-4 col-lg-3 mb-1'>";
                                    echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                    echo "<label for='$nombre' class='$clase'>$nombre</label>";
                                    echo "</div>";
                                }
                            }
                            // Reset the result pointer to the beginning
                            mysqli_data_seek($resultado, 0);
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
                <input type="submit" class="col-5 col-md-4 col-lg-3 b mt-2 btn btn-success" value="Añadir al carrito">
            </div>
        </form>

        <div class="row justify-content-center text-center">
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
                <input type="submit" class="col-5 col-md-4 col-lg-3 btn btn-primary" value="Enviar pedido">
            </form>
        </div>
    </div>


    </div>
</body>

</html>