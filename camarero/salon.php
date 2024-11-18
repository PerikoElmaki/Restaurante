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
            <a href="menuCamarero.php" class="btn btn-primary"><i class="bi bi-arrow-return-left"></i></a>
        </div>
        <div class="centrar">
            <h1>Salón</h1>
            <!-- Saludar camarero -->
            <?php
            $nombre = $_SESSION['nombre'];
            $camareroId = $_SESSION['id']; // Asegúrate de que el ID del camarero está almacenado en la sesión
            echo "<h3>Camarero: $nombre</h3>";
            ?>
        </div>
    </nav>
    <section>
        <div class="mesasContainer">
            <?php
            $consulta = "SELECT * FROM mesas";
            $resultado = mysqli_query($conn, $consulta);

            while ($fila = mysqli_fetch_array($resultado)) {
                $id = $fila['codigo'];
                $ocupada = $fila['estado'];

                if ($ocupada == 0) {

                    echo "<div class='mesaLibre'><a class='enlaceMesaId' href='2formCrearPedido.php?id=$id'>$id</a></div>";
                } else {
                    // Hacemos select en pedidos where mesa = id 
                    echo "<div class='mesaOcupada'><a class='enlaceMesaId' href='listarPedido.php?id=$id'>$id</a></div>";
                }
            }
            ?>
        </div>
    </section>
</body>

</html>