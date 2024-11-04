<?php
    include "../sesion.php";
    include "../conexion.php";

    $usuario = $_POST['nombre'];
    $contra = $_POST['contraseña'];
    $dni = $_POST['dni'];
    $fotoEnlace = $_POST['dni'];
    $encargado = $_POST['encargado'];

    $consulta = "INSERT INTO restaurante (codigo,producto,detalle,precio,descuento,imagen) VALUES ('$cod','$pro','$det','$pre','$des','$ima')";

?>