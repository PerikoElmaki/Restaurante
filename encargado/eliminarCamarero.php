<?php
include "sesionEncargado.php";
include "../conexion.php";

$id = $_GET['id'];
$sql = "DELETE FROM camareros WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Producto eliminado exitosamente.";
} else {
    echo "Error al eliminar el producto.";
}

$stmt->close();
$conn->close();

header("LOCATION:listadoCamareros.php");
?>