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

    <title>Crear Pedido</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: rgb(244, 244, 244);
        }

        .cont {
            background-color:rgb(50, 50, 50);;
            border-radius: 7px;
            padding: 20px;
        }

        .categ {
            background-color: aliceblue;
            padding: 20px;
            border-radius: 5px;
            
        }

        .btn-group .btn {
            width: 100%;
            height: 100%;
            align-content: center;
        }

        @media (min-width: 768px) {
            .categ {
                margin-left: auto;
                margin-right: auto;
            }
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

    <div class="container">
        <h2>Realiza tu Pedido</h2>
        <form action="" method="post">
            <input type="hidden" name="mesaId" value="<?php echo $idmesa; ?>">
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
                                            $buttonClass = 'warning';
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
                </div>
                <input type="submit" class="btn btn-primary" value="Enviar pedido">
        </form>
    </div>

</body>

</html>