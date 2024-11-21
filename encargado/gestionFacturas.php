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
            <a href="menuEncargado.php" class="btn btn-primary"><i class="bi bi-arrow-return-left"></i></a>
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
    <div class="container d-flex justify-content-center align-items-center">
        <section class="container">
            <div class="row justify-content-center text-center g-5">
                <!-- Estadísticas -->
                <div class="col-12 col-md-6 ">
                    <h3>📊 Estadísticas</h3>
                    <canvas id="ventasChart"></canvas>
                    <script>
                        var ctx = document.getElementById('ventasChart').getContext('2d');
                        var ventasChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
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
                <!-- Informes de Ventas -->
                <div class="col-12 col-md-6 mt-4 ">
                    <div class="row justify-content-center">
                    <h3>📈 Informes de Ventas</h3>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Informes de Ventas</h5>
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
                                    <ul class="list-group">
                                        <li class="list-group-item">Informe Enero</li>
                                        <li class="list-group-item">Informe Febrero</li>
                                        <li class="list-group-item">Informe Marzo</li>
                                        <li class="list-group-item">Informe Abril</li>
                                        <li class="list-group-item">Informe Mayo</li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Listado de Usuarios -->
                <div class="col-12 col-md-6">
                    <h3>👥 Listado de Usuarios</h3>
                    <ul class="list-group">
                        <li class="list-group-item">Usuario 1</li>
                        <li class="list-group-item">Usuario 2</li>
                        <li class="list-group-item">Usuario 3</li>
                    </ul>
                </div>
                <!-- Gestión de Productos -->
                <div class="col-12 col-md-6">
                    <h3>🛒 Gestión de Productos</h3>
                    <p>Añadir Producto</p>
                    <p>Modificar Producto</p>
                    <p>Eliminar Producto</p>
                </div>
                <!-- Gestión de Pedidos -->
                <div class="col-12 col-md-6">
                    <h3>📦 Gestión de Pedidos</h3>
                    <p>Ver Pedidos</p>
                    <p>Actualizar Estado</p>
                    <p>Eliminar Pedido</p>
                </div>
            </div>
        </section>
    </div>
</body>

</html>