<?php
include "../sesion.php";
include "../conexion.php";

// Eliminar del carrito
if (isset($_POST['eliminarProducto'])) {
    $idProductoEliminar = $_POST['eliminarProducto'];
    $deleteQuery = "DELETE FROM lineas_carrito WHERE producto = '$idProductoEliminar'";
    mysqli_query($conn, $deleteQuery);
    // Redirigir para evitar duplicación de datos al recargar
    header("Location: formCrearPedido.php?id=$mesaId");
    
}
?>