<?php
include "../conexion.php";
include "../sesion.php";

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

<body class="cuerpoIndex">
    <nav>
        <div class="volver">
            <a href="../logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-in-left"></i></a>
        </div>
        <div class="centrar">
            <h3>Menu Camareros</h3>
            <!-- Saludar camarero -->
            <?php
            $nombre = $_SESSION['nombre'];
            echo "<h5 class='roboTitle mt-1'>Bienvenido, $nombre</h5>";
            ?>
        </div>
    </nav>
    <section class="container">
        <div class="row justify-content-center">

            <div class="cartas card col-7 col-md-3 mb-4 me-3 bg-dark ">
                <div class="card-body">
                    <a href="salon.php" class="btn stretched-link text-white">
                        <h5 class="card-title">Acceder al salón</h5>
                    </a>
                </div>
            </div>
            <div class="cartas card col-7 col-md-3 mb-4 me-3 border-dark ">
                <div class="card-body">
                    <a href="listadoProductos.php" class="btn border-white text-dark stretched-link">
                        <h5 class="card-title">Stock de productos</h5>
                    </a>
                </div>
            </div>

        </div>

        <hr>
        <h6 class="text-white ">Día de servicio: <?php echo date('d-m-Y'); ?> </h6>

    </section>
</body>

</html>