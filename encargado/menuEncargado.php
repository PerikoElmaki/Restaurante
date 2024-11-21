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
<style>
    body,
    html {
        height: 100%;
        margin: 0;
    }

    .container {
        height: 60vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
</style>

<body>
    <nav>
        <div class="volver">
            <a href="../logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-in-left"></i></a>
        </div>
        <div class="centrar">
            <h3 class="roboTitle">Menú Encargado</h3>
            <!-- Saludar camarero -->
            <?php
            $nombre = $_SESSION['nombre'];
            echo "<h5 class='roboTitle'>Bienvenido, $nombre</h5>";
            ?>
        </div>
    </nav>

    <section class="container">

        <!-- Button trigger modal for Gestionar productos -->
        <div class="row justify-content-center">
            <div class="cartas card col-8 col-md-5 mb-4 me-3 bg-dark ">
                <div class="card-body">
                    <a href="listadoProductos.php" class="btn stretched-link text-white" data-bs-toggle="modal" data-bs-target="#productosModal">
                        <h5 class="card-title">Gestionar productos</h5>
                    </a>
                </div>
            </div>

            <!-- Modal for Gestionar productos -->
            <div class=" modal fade" id="productosModal" tabindex="-1" aria-labelledby="productosModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productosModalLabel">Gestión de productos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="modal-text">Accede a los apartados</p>
                            <a href="listadoProductos.php" class="btn btn-primary btn-lg me-3">Listado-stock</a>
                            <a href="formAñadirProductos.php" class="btn btn-warning btn-lg">Añadir producto</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-grid">
                <br>
                <br>
            </div>
            <!-- Button trigger modal for Gestionar camareros -->
            <div class="cartas card col-8 col-md-5  mb-4 me-3 border-dark ">
                <div class="card-body">
                    <a href="formAñadirProductos.php" class="btn border-white text-dark stretched-link" data-bs-toggle="modal" data-bs-target="#camarerosModal">
                        <h5 class="card-title">Gestionar camareros</h5>
                    </a>
                </div>
            </div>


            <!-- Modal for Gestionar camareros -->
            <div class="modal fade" id="camarerosModal" tabindex="-1" aria-labelledby="camarerosModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="camarerosModalLabel">Gestionar camareros</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="modal-text"><b>Atención</b>, las contraseñas son visibles</p>
                            <a href="listadoCamareros.php" class="btn btn-primary btn-lg me-3">Gestión y listado</a>
                            <a href="formAñadirCamarero.php" class="btn btn-warning btn-lg">Añadir camarero</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button trigger modal for Gestionar facturas -->
            <div class="cartas card col-8 col-md-5 mb-4 me-3 bg-success">
                <div class="card-body">
                    <a href="listadoFacturas.php" class="btn stretched-link text-white" data-bs-toggle="modal" data-bs-target="#facturasModal">
                        <h5 class="card-title">Gestionar facturas</h5>
                    </a>
                </div>
            </div>

            <!-- Modal for Gestionar facturas -->
            <div class="modal fade" id="facturasModal" tabindex="-1" aria-labelledby="facturasModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="facturasModalLabel">Gestionar facturas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <a href="gestionFacturas.php" class="btn btn-primary">Ir a listado de facturas</a>
                        </div>
                    </div>
                </div>
            </div>





        </div>


        <hr>
        <span>Día de servicio: </span>
        <?php echo date('d-m-Y'); ?>
    </section>
</body>

</html>