<?php
include("conexion.php");
$error = false;
$usuario = $_POST['nombre'];
$clave = $_POST['contraseña'];
$consulta = "SELECT * FROM camareros WHERE nombre='$usuario' AND contraseña='$clave'";

$resultado = mysqli_query($conn, $consulta);

if (mysqli_num_rows($resultado) == 1) {
    echo "Usuario y clave correctos";
    header("LOCATION:../menu.php");
} else {
    echo "ERROR en el usuario $usuario o contraseña son incorrectos<br>";
    echo "<a href='../inicioSesion.html'>Volver al inicio</a>";
}


session_start();
$fila = mysqli_fetch_array($resultado);
$_SESSION['id'] = $fila['id'];
$_SESSION['nombre'] = $fila['nombre'];
$_SESSION['contraseña'] = $fila['contraseña'];
$_SESSION['encargado'] = $fila['encargado'];

?>