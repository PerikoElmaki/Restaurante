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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

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
    <div class="container d-flex justify-content-center align-items-center">
        <section class="container">
            <div class="row justify-content-center text-center g-5">
                <!-- Estadísticas -->
                <style>
                    .est {
                        height: 30vh;
                    }
                </style>

                <!-- Informes de Ventas -->
                <!-- <div class="col-12 col-md-6 mt-4 "> -->
                <div class="row justify-content-center mt-5">
                    <h3>📈 Informes de Ventas</h3>
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Visualiza y descarga los informes de ventas mensuales.</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#informesModal">
                                Ver Informes
                            </button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="informesModal" tabindex="-1" aria-labelledby="informesModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="informesModalLabel">Informes de Ventas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="generarFactura.php" method="post">
                                        <div class="mb-3">
                                            <label for="fecha" class="form-label">Selecciona una fecha:</label>
                                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Buscar Informe</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <!-- Listado de Usuarios -->
                    <!-- <div class="col-md-5"> -->

                    <div class="card col-5 mb-3">
                        <div class="card-body">
                            <h5 class="card-title">👥 Usuarios</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#usuariosModal">
                                Gestionar
                            </button>
                        </div>
                        <div class="modal fade" id="usuariosModal" tabindex="-1" aria-labelledby="usuariosModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="usuariosModalLabel">Usuarios</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <a href="listadoCamareros.php" class="btn btn-primary ">Listado Usuario</a>
                                        <a href="formAñadirCamarero.php" type="button" class="btn btn-warning">Añadir Usuario</a>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->


                    <div class="card col-5 mb-3 offset-1">
                        <div class="card-body">
                            <h5 class="card-title">📦Productos</h5>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productosModal">
                                Gestionar
                            </button>

                            <div class="modal fade" id="productosModal" tabindex="-1" aria-labelledby="productosModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="productosModalLabel">Productos</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="listadoProductos.php" class="btn btn-primary">Listado Productos</a>
                                            <a href="formAñadirProductos.php" type="button" class="btn btn-warning">Añadir Producto</a>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="est col-12 col-md-6 mt-5">
                <h3>📊 Estadísticas</h3>
                <canvas id="ventasChart"></canvas>
                <script>
                    var ctx = document.getElementById('ventasChart').getContext('2d');
                    var ventasChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                            datasets: [{
                                label: 'Total Ventas (€)',
                                data: [1200, 1900, 3000, 5000, 2300],
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
            <!-- </div> -->
        </section>
    </div>
</body>

</html>