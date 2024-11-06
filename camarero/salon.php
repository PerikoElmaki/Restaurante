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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav>
        <div class="volver">
            <h4><a href="menuCamarero.php">
                    <=Volver al menu
                        </a>
            </h4>
        </div>
        <div class="centrar">
            <h1>Salón</h1>
            <!-- Saludar camarero -->
            <?php
            $nombre = $_SESSION['nombre'];
            echo "<h3>Camarero: $nombre</h3>";
            ?>
        </div>
    </nav>
    <section>
        <div class="mesasContainer">
            <?php
            $consulta = "SELECT * FROM mesas";

            $resultado = mysqli_query($conn, $consulta);

            // SI está ocupada la mesa, te lleva a modificar ese pedido
            //Si no, te lleva a crear pedido

            while ($fila = mysqli_fetch_array($resultado)) {
                $id = $fila['codigo'];
                $ocupada = $fila['estado'];

                if ($ocupada == 0) {
                    // nos llevamos por get el id de la mesa para añadirlo al pedido
                    echo "<div class='mesaLibre'><a class='enlaceMesaId' href='formCrearPedido.php?id=$id'>$id</a></div>";
                } else {
                    // Hacemos select en pedidos where mesa = id 
                    echo "<div class='mesaOcupada'><a class='enlaceMesaId' href='formModificarPedido.php?id=$id'>$id</a></div>";
                }
            }
            ?>
        </div>


    </section>
</body>

</html>