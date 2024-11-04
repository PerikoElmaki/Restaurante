<?php
include "conexion.php";

$usuario = $_POST['nombre'];
$clave = $_POST['contraseña'];
$consulta = "SELECT * FROM camareros WHERE nombre='$usuario' AND contraseña='$clave'";

$resultado = mysqli_query($conn, $consulta);

if (mysqli_num_rows($resultado) == 1) {
    $fila = mysqli_fetch_assoc($resultado);
   
    session_start();


    $_SESSION['id'] = $fila['id'];
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['contraseña'] = $fila['contraseña'];
    $_SESSION['encargado'] = $fila['encargado'];

    if($fila['encargado'] == 1){
        header("LOCATION:encargado/menuEncargado.php");
    }elseif ($fila['encargado'] == 0){
        header("LOCATION:camarero/menuCamarero.php");
    }
    
}else{
    header("LOCATION:index.php");
} 




?>