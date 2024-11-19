<?php
include "../sesion.php";
include "../conexion.php";

// Eliminar del carrito

// COMPROBAR si solo hay un articulo al darle a eliminar, truncate table
if (isset($_POST['eliminarProducto'])) {
    $idProductoEliminar = $_POST['eliminarProducto'];
    $mesaId =$_POST['mesaId'];
    $deleteQuery = "DELETE FROM lineas_carrito WHERE producto = '$idProductoEliminar'";
    mysqli_query($conn, $deleteQuery);
    // Redirigir para evitar duplicación de datos al recargar
    header("Location: formCrearPedido.php?mesaId=$mesaId");
    
}
?>