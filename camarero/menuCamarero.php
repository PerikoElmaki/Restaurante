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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav>
        <div class="volver">
            <a href="../logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-in-left"></i></a>
        </div>
        <div class="centrar">
            <h1>Menu Camareros</h1>
            <!-- Saludar camarero -->
            <?php
            $nombre = $_SESSION['nombre'];
            echo "<h3>Bienvenido, $nombre</h3>";
            ?>
        </div>
    </nav>
    <section>
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Salón y comandas</h5>
        <a href="salon.php" class="btn btn-primary">Ir al salón</a>
        </div>
    </div>
      
        <!-- Añadir mesa falta -->
        <hr>

    </section>
</body>

</html>