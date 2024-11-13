<?php
    include "../sesion.php";
    include "../conexion.php";

    $usuario = $_POST['nombre'];
    $contra = $_POST['contraseña'];
    $dni = $_POST['dni'];
    $foto = $_POST['dni'].'.jpg';
    $encargado = $_POST['encargado'];

    $consulta = "INSERT INTO camareros VALUES ('NULL','$usuario','$contra','$dni','$foto','$encargado')";

    $resultado = mysqli_query($conn, $consulta);

    header("LOCATION:menuEncargado.php");

?>