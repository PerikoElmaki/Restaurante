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

<body>
    <nav>
        <div class="volver">
            <a href="2menuEncargado.php" class="btn btn-primary"><i class="bi bi-arrow-return-left"></i></a>
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
    <section class="container">
        <div class="content row">
            <div class="col ">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Contraseña</th>
                        <th>DNI</th>
                        <th>Foto</th>
                        <th class="text-start">¿Encargado?</th>
                    </tr>
                    <?php
                    $consulta = "SELECT * FROM camareros";

                    $resultado = mysqli_query($conn, $consulta);

                    while ($fila = mysqli_fetch_array($resultado)) {
                        $enlaceBorrar = "";
                        $id = $fila['id'];
                        $nombre = $fila['nombre'];
                        $contra = $fila['contraseña'];
                        $dni = $fila['dni'];
                        // Cambiar esto en base de datos
                        $fotoEnlace = $fila['foto'];
                        $encargadoNum = $fila['encargado'];
                        $suspendido = $fila['suspendido'];

                        $esEncargado = 'No';

                        if ($encargadoNum == 1) {
                            $esEncargado = 'Si';
                        }
                        if ($suspendido == 1) {
                            $clase = 'table-danger';
                        } else {
                            $clase = 'table-success';
                        }

                        echo "<tr class='$clase'>";
                        echo "<td class='tdPedidos'>$id</td>";
                        echo "<td class='tdPedidos'>$nombre</td>";
                        echo "<td class='tdPedidos'>$contra</td>";
                        echo "<td class='tdPedidos'>$dni</td>";
                        echo "<td class='fotoCam'><img width='40px' src='images/" . $fotoEnlace . "'></td>";
                        echo "<td class='tdPedidos'>$esEncargado ";
                        echo "<a href='eliminarCamarero.php?id=$id' class='ms-3 btn btn-danger'><i class='bi bi-trash'></i></a>";
                        if ($suspendido == 1) {
                            echo "<a href='modificarCamarero.php?id=$id&susp=$suspendido' class='ms-3 btn btn-success'><i class='bi bi-toggle-on'></i></a>";
                        } else {
                            echo "<a href='modificarCamarero.php?id=$id&susp=$suspendido' class='ms-3 btn btn-warning'><i class='bi bi-toggle-off'></i></a>";
                        }
                        echo "</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

    </section>
</body>

</html>