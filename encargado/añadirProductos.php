<?php
include "sesionEncargado.php";
include "../conexion.php";

$nombre = $_POST['nombre'];
$categ = $_POST['categoria'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];


$consulta = "INSERT INTO productos VALUES ('NULL','$nombre','$categ','$precio','$stock')";

$resultado = mysqli_query($conn, $consulta);

header("LOCATION:listadoProductos.php");
?>