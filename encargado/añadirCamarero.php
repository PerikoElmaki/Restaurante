<?php
    include "../sesion.php";
    include "../conexion.php";

    $usuario = $_POST['nombre'];
    $contra = $_POST['contraseña'];
    $dni = $_POST['dni'];
    $fotoEnlace = $_POST['dni'];
    $encargado = $_POST['encargado'];

    $consulta = "INSERT INTO camareros VALUES ('NULL','$usuario','$contra','$dni','$dni','$encargado')";

    $resultado = mysqli_query($conn, $consulta);

    header("LOCATION:menuEncargado.php");

?>