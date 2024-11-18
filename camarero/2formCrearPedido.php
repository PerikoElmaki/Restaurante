<?php
include "../sesion.php";
include "../conexion.php";

$mesaId = isset($_GET['id']) ? $_GET['id'] : null;
if ($mesaId === null) {
    die("Error: id de mesa no especificado.");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pedido</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .cont {
            background-color: black;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Mesa <?php echo $idmesa; ?></h1>
        <?php
        $nombre = $_SESSION['nombre'];
        echo "<h3>Camarero: $nombre</h3>";
        ?>
    </div>
    </nav>
    <section>
        <div class="container">
            <h2>Realiza tu Pedido</h2>
            <form action="crearPedido.php" method="post">
                <input type="hidden" name="mesaId" value="<?php echo $idmesa; ?>">
                <!-- contenedor -->
                <div class="row justify-content-center">
                    <div class="cont row g-5">
                        <!-- header con botones link -->
                        <div class="col-12">
                            <div class="btn-group">
                                <a href="#bebidas" class="btn btn-primary">Bebidas</a>
                                <a href="#entrantes" class="btn btn-warning">Entrantes</a>
                                <a href="#ensaladas" class="btn btn-success">Ensaladas</a>
                                <a href="#pastas" class="btn btn-danger">Pastas</a>
                                <a href="#pizzas" class="btn btn-info">Pizzas</a>
                                <a href="#postres" class="btn btn-secondary">Postres</a>
                            </div>
                        </div>

                        <?php
                        $consulta = "SELECT * FROM productos";
                        $resultado = mysqli_query($conn, $consulta);

                        $categorias = [
                            'Bebida' => 'bebidas',
                            'Entrante' => 'entrantes',
                            'Ensalada' => 'ensaladas',
                            'Pasta' => 'pastas',
                            'Pizza' => 'pizzas',
                            'Postre' => 'postres'
                        ];

                        foreach ($categorias as $categoria => $clase) {
                            echo "<div class='col-12 col-md-6 col-lg-4' id='$clase'>";
                            echo "<h3>" . ucfirst($clase) . "</h3>";
                            while ($fila = mysqli_fetch_array($resultado)) {
                                if ($fila['categoria'] == $categoria) {
                                    $id = $fila['id'];
                                    $nombre = $fila['nombre'];
                                    $precio = $fila['precio'];
                                    $stock = $fila['stock'];

                                    echo "<div class='col-4 col-md-3 col-lg-2 mb-1'>";
                                    echo "<input type='checkbox' name='productosSeleccionados[]' id='$nombre' class='btn-check' value='$id'>";
                                    echo "<label for='$nombre' class='btn btn-outline-primary'>$nombre</label>";
                                    echo "</div>";
                                }
                            }
                            // Reset the result pointer to the beginning
                            mysqli_data_seek($resultado, 0);
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Enviar pedido">
            </form>
        </div>
    </section>
</body>

</html>