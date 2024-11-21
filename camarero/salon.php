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

<body>
    <nav>
        <div class="volver">
            <a href="menuCamarero.php" class="btn btn-primary"><i class="bi bi-arrow-return-left"></i></a>
        </div>
        <div class="centrar">
            <h3>Salón y comandas</h3>
            <!-- Saludar camarero -->
            <?php
            $nombre = $_SESSION['nombre'];
            echo "<h5>Camarero: $nombre</h5>";
            ?>
        </div>
    </nav>
    <section>
        <!-- CAMBIAR POR CARDS, hacedlo bonico -->
        <div class="mesasContainer">
            <?php
            $consulta = "SELECT * FROM mesas";
            $resultado = mysqli_query($conn, $consulta);

            while ($fila = mysqli_fetch_array($resultado)) {
                $id = $fila['codigo'];
                $ocupada = $fila['estado'];

                if ($ocupada == 0) {

                    echo "<div class='mesaLibre'><a class='enlaceMesaId' href='formCrearPedido.php?mesaId=$id'>$id</a></div>";
                } else {
                    // Hacemos select en pedidos where mesa = id 
                    echo "<div class='mesaOcupada'><a class='enlaceMesaId' href='listarPedido.php?mesaId=$id'>$id</a></div>";
                }
            }
            ?>
        </div>
        <hr>
        <span>Día de servicio: </span>
        <?php echo date('d-m-Y'); ?>
    </section>

    <?php
    $truncateQuery = "TRUNCATE TABLE lineas_carrito";
    if (mysqli_query($conn, $truncateQuery)) {
        // echo "Table lineas_carrito truncated successfully.";
    } else {
        // echo "Error truncating table: " . mysqli_error($conn);
    }
    ?>
</body>

</html>