<?php
include "../sesion.php";
include "../conexion.php";

$mesaId = isset($_GET['mesaId']) ? $_GET['mesaId'] : null;
if ($mesaId === null) {
    die("Error: id de mesa no especificado.");
}


// Obtener el ID del pedido asociado a la mesa y la fecha
$consultaPedido = "SELECT id, hora FROM pedidos WHERE mesa = '$mesaId'"; // Asegúrate de que el estado del pedido es 0 (activo)
$resultadoPedido = mysqli_query($conn, $consultaPedido);
if ($resultadoPedido && mysqli_num_rows($resultadoPedido) > 0) {
    $filaPedido = mysqli_fetch_assoc($resultadoPedido);
    $pedidoId = $filaPedido['id'];
    $horaPedido = $filaPedido['hora'];
} else {
    die("Error: No se encontró un pedido activo para esta mesa.");
}



$consultaLineas = "
    SELECT lp.*, 
           (SELECT p.nombre FROM productos p WHERE p.id = lp.producto) AS nombre,
           (SELECT p.precio FROM productos p WHERE p.id = lp.producto) AS precio
    FROM lineas_pedidos lp 
    WHERE lp.pedido = '$pedidoId'";
$resultadoLineas = mysqli_query($conn, $consultaLineas);

// Obtener el precio de los productos y guardarlos en un array
$preciosProductos = [];
$consultaPrecios = "SELECT id, precio FROM productos";
$resultadoPrecios = mysqli_query($conn, $consultaPrecios);
if ($resultadoPrecios && mysqli_num_rows($resultadoPrecios) > 0) {
    while ($filaPrecio = mysqli_fetch_assoc($resultadoPrecios)) {
        $preciosProductos[$filaPrecio['id']] = $filaPrecio['precio'];
    }
}

// Comprobar si el camarero es encargado
$nombre = $_SESSION['nombre'];
$consultaEncargado = "SELECT encargado FROM camareros WHERE nombre = '$nombre'";
$resultadoEncargado = mysqli_query($conn, $consultaEncargado);
if ($resultadoEncargado && mysqli_num_rows($resultadoEncargado) > 0) {
    $filaEncargado = mysqli_fetch_assoc($resultadoEncargado);
    $esEncargado = $filaEncargado['encargado'];
} else {
    $esEncargado = 0; // Asumimos que no es encargado si no se encuentra en la base de datos
}

// Inserción en carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['productosSeleccionados'])) {
        $productosSeleccionados = $_POST['productosSeleccionados'];
        foreach ($productosSeleccionados as $idProducto) {
            $insertQuery = "INSERT INTO lineas_carrito (producto) VALUES ('$idProducto')";
            mysqli_query($conn, $insertQuery);
        }
        // Redirigir para evitar duplicación de datos al recargar
        header("Location: listarPedido.php?mesaId=$mesaId");
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Pedido</title>
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
            <a href="salon.php" class="btn btn-primary"><i class="bi bi-arrow-return-left"></i></a>
        </div>
        <div class="centrar">
            <?php
            $mesaId = $_GET['mesaId'];
            echo "<h3>Mesa $mesaId</h3>";
            echo "<h5>Camarero: $nombre</h5>";
            ?>
        </div>
    </nav>
    <div>
        <section>
            <div class="container">
                <div class="row justify-content-start mt-1 ">

                    <h2 class="col-9 mt-1">Artículos del Pedido : <?php echo date('H:i', strtotime($horaPedido)); ?></h2>
                    <?php
                    echo "<a href='ticketCocina.php?pedidoId=$pedidoId&mesaId=$mesaId' class='col-3 col-md-2 btn btn-secondary'><i class='bi bi-printer'></i> <br>Ticket cocina</a>";
                    ?>
                </div>
                <?php

                if ($resultadoLineas && mysqli_num_rows($resultadoLineas) > 0) {
                    echo "<table class='table'>";
                    echo "<thead><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Comentario</th></tr></thead>";
                    echo "<tbody>";
                    while ($filaLinea = mysqli_fetch_assoc($resultadoLineas)) {
                        $nombreProducto = $filaLinea['nombre'];
                        $cantidad = $filaLinea['cant'];
                        $comentario = $filaLinea['comentario'];
                        $precio = $filaLinea['precio'];
                        
                        $consultaCategoria = "SELECT categoria FROM productos WHERE nombre = '$nombreProducto'";
                        $resultadoCategoria = mysqli_query($conn, $consultaCategoria);
                        $categoria = '';
                        if ($resultadoCategoria && mysqli_num_rows($resultadoCategoria) > 0) {
                            $filaCategoria = mysqli_fetch_assoc($resultadoCategoria);
                            $categoria = $filaCategoria['categoria'];
                        }

                        // Ponemos clase a row según categoría
                        switch ($categoria) {
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
                        echo "<td class='tdPedidos'>$nombreProducto</td>";
                        echo "<td class='tdPedidos'>$cantidad</td>";
                        echo "<td class='tdPedidos'>$precio</td>";
                        echo "<td class='tdPedidos'>$comentario";
                        if ($esEncargado == 1) {
                            echo "<a href='eliminarLinea.php?pedidoId=$pedidoId&nombreProd=$nombreProducto&precio=$precio' class='ms-3 btn btn-danger'><i class='bi bi-trash'></i></a>";
                        }
                        echo "</td></tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>No hay artículos en este pedido.</p>";
                }
                ?>
            </div>
            <div class="d-flex justify-content-center mb-3 ">
                <?php
                    if ($esEncargado == 1) {
                        echo "<a href='eliminarPedido.php?pedidoId=$pedidoId&mesaId=$mesaId' class='ms-3 btn btn-danger'>Eliminar pedido</a>";
                    }
                ?>
            </div>
        </section>
        <section>

            <div class="container">
                <div class="title">
                    <h2 class="col-12 mt-4">Añadir al Pedido</h2>
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

                                            if ($stock < 10 && $stock > 1) {
                                                echo "<div class='d-grid col-6 col-sm-6 col-md-4 col-lg-3 mb-1'>";
                                                echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                                echo "<label for='$nombre' class='$clase'>$nombre <br>(consultar stock)</label>";
                                                echo "</div>";
                                            } else if ($stock == 0) {
                                                echo "<div class='d-grid col-6 col-sm-6 col-md-4 col-lg-3 mb-1'>";
                                                echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id' disabled>";
                                                echo "<label for='$nombre' class='$clase'>$nombre <br>SIN STOCK</label>";
                                                echo "</div>";
                                            } else {
                                                echo "<div class='d-grid col-6 col-sm-6 col-md-4 col-lg-3 mb-1'>";
                                                echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                                echo "<label for='$nombre' class='$clase'>$nombre</label>";
                                                echo "</div>";
                                            }
                                            // echo "<div class='d-grid col-6 col-sm-6 col-md-4 col-lg-3 mb-1'>";
                                            // echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                            // echo "<label for='$nombre' class='$clase'>$nombre</label>";
                                            // echo "</div>";
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


                    <form action="añadirPedido.php" id="enviarPedido" method="post">
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
                                        echo "<input type='hidden' name='pedidoId' value='$pedidoId'>";
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
                            <input type="submit" class="col-7 mt-3 btn btn-primary" value="Añadir al pedido ">
                        </div>
                    </form>
                </div>
            </div>

        </section>
        <br>
        <hr>
        <!-- Total y pagar -->
        <footer class="row justify-content-start">
            <?php
            // Obtener el total del pedido
            $consultaTotal = "SELECT total FROM pedidos WHERE id = '$pedidoId'";
            $resultadoTotal = mysqli_query($conn, $consultaTotal);
            if ($resultadoTotal && mysqli_num_rows($resultadoTotal) > 0) {
                $filaTotal = mysqli_fetch_assoc($resultadoTotal);
                $totalPedido = $filaTotal['total'];

                // Mostrar con impuestos 
                $impuestos = $totalPedido * 0.10;
                $totalConImpuestos = $totalPedido + $impuestos;

                echo "<h2 class='col-5 mt-2 ms-3'>Total: $totalConImpuestos $</h2>";
            } else {
                echo "<h2>Total: No disponible</h2>";
            }
            ?>
            <div class="col-6 ">
                <div class="row justify-content-start">
                    <form id="ticketForm" class="col-5" action="ticketCliente.php" method="post">
                        <?php
                        // enviamos datos a crearTicket
                        mysqli_data_seek($resultadoLineas, 0); // Reset the result pointer to the beginning
                        while ($filaLinea = mysqli_fetch_assoc($resultadoLineas)) {
                            $nombreProducto = $filaLinea['nombre'];
                            $cantidad = $filaLinea['cant'];
                            $comentario = $filaLinea['comentario'];
                            $precio = $filaLinea['precio'];
                            echo "<input type='hidden' name='productos[]' value='$nombreProducto'>";
                            echo "<input type='hidden' name='cantidades[]' value='$cantidad'>";
                            echo "<input type='hidden' name='comentarios[]' value='$comentario'>";
                            echo "<input type='hidden' name='precios[]' value='$precio'>";
                        }
                        ?>
                        <input type="hidden" name="mesaId" value="<?php echo $mesaId; ?>">
                        <input type="hidden" name="pedidoId" value="<?php echo $pedidoId; ?>">
                        <input type="hidden" name="totalPedido" value="<?php echo $totalPedido; ?>">
                        <button type="submit" class="btn btn-dark ms-5"><i class="bi bi-printer"></i><br> Imprimir cuenta</button>
                    </form>
                    <!-- El de pagar va a abrir un modal -->
                    <button class="col-4 col-md-4 offset-md-1 btn btn-warning ms-5" data-bs-toggle="modal" data-bs-target="#myModal">Tramitar pago</button>
                </div>
            </div>
            <!-- modal para confirmar que vas a pagar -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmar pago</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Confirma que han pagado los <b><?php echo "$totalConImpuestos"; ?></b> euros y que no faltan perras.
                            <p>Luego el jefe se enfada....</p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <form id="pagarForm" action="pagarPedido.php" method="post">
                                <!-- Nos llevamos el id de la mesa y el id del pedido para hacer el update -->

                                <input type="hidden" name="mesaId" value="<?php echo $mesaId; ?>">
                                <input type="hidden" name="pedidoId" value="<?php echo $pedidoId; ?>">
                                <input type="submit" class="btn btn-success" value="Confirmar y pagar">
                            </form>
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>

                    </div>
                </div>
            </div>


        </footer>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function incrementQuantity(button) {
            var input = button.previousElementSibling;
            input.value = parseInt(input.value) + 1;
        }

        function decrementQuantity(button) {
            var input = button.nextElementSibling;
            input.value = parseInt(input.value) - 1;
            if (input.value < 1) {
                input.value = 1;
            }
        }
    </script>
</body>

</html>

<?php
mysqli_close($conn);
?>