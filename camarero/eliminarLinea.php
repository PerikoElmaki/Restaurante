<?php
include "../encargado/sesionEncargado.php";
include "../conexion.php";

$pedidoId = $_GET['pedidoId'];
$nombreProd = $_GET['nombreProd'];
$precio = $_GET['precio'];

// Obtener el ID del producto basado en el nombre del producto
$sql = "SELECT id FROM productos WHERE nombre = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombreProd);
$stmt->execute();
$stmt->bind_result($productoId);
$stmt->fetch();
$stmt->close();

// Eliminar la línea del pedido
$sql = "DELETE FROM lineas_pedidos WHERE pedido = ? AND producto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $pedidoId, $productoId);
$stmt->execute();

// Actualizar el total del pedido
$sql = "UPDATE pedidos SET total = total - ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("di", $precio, $pedidoId);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Producto eliminado exitosamente.";
} else {
    echo "Error al eliminar el producto.";
}

$stmt->close();
$conn->close();

// Redirigir a la página del salón
header("Location: salon.php");
exit();
?>