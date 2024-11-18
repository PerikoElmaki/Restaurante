<?php
include "../sesion.php";
include "../conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productosSeleccionados'])) {
    $productosSeleccionados = $_POST['productosSeleccionados'];
    $nombresProductos = $_POST['nombresProductos'];
    foreach ($productosSeleccionados as $idProducto) {
        $nombreProducto = $nombresProductos[$idProducto];
        $insertQuery = "INSERT INTO lineas_carrito (nombre,producto) VALUES ('$nombreProducto','$idProducto')";
        mysqli_query($conn, $insertQuery);
    }
}

header("LOCATION:salon.php");
?>