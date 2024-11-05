<?php
include "../sesion.php";
include "../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <!-- <link rel="stylesheet" href="../styles.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <h2>Encargado</h2>
            <!-- Saludar camarero -->
            <?php
            $nombre = $_SESSION['nombre'];
            echo "<h3>$nombre</h3>";
            ?>
        </div>
    </nav>
    <section>
        <div class="container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Contraseña</th>
                    <th>DNI</th>
                    <th>Foto</th>
                    <th>¿Encargado?</th>
                </tr>
                <?php
                $consulta = "SELECT * FROM camareros";

                $resultado = mysqli_query($conn, $consulta);

                while ($fila = mysqli_fetch_array($resultado)) {

                    $id = $fila['id'];
                    $nombre = $fila['nombre'];
                    $contra = $fila['contraseña'];
                    $dni = $fila['dni'];
                    $fotoEnlace = $fila['foto'];
                    $encargadoNum = $fila['encargado'];

                    $esEncargado = 'No';
                    if ($encargadoNum == 1) {
                        $esEncargado = 'Si';
                    }
                    echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td>$nombre</td>";
                    echo "<td>$contra</td>";
                    echo "<td>$dni</td>";
                    echo "<td>$fotoEnlace</td>";
                    echo "<td>$esEncargado</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </section>
</body>

</html>