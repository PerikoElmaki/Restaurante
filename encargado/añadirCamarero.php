<?php
    include "sesionEncargado.php";
    include "../conexion.php";

    $usuario = $_POST['nombre'];
    $contra = $_POST['contraseña'];
    $dni = $_POST['dni'];
    $foto = $_POST['dni'].'.jpg';
    $encargado = $_POST['encargado'];

    $consulta = "INSERT INTO camareros VALUES ('NULL','$usuario','$contra','$dni','$foto','$encargado',1)";

    $resultado = mysqli_query($conn, $consulta);

    header("LOCATION:2menuEncargado.php");

?>