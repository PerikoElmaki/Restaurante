<?php
include "sesionEncargado.php";
include "../conexion.php";

$id = $_GET['id'];
$sql = "UPDATE productos SET stock = 50 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
$conn->close();

header("LOCATION:listadoProductos.php");
?>