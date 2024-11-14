<?php
include "../sesion.php";
include "../conexion.php";
// Obtener el id de la mesa y el id del pedido del formulario pagarForm
$mesaId = $_POST['mesaId'];
$pedidoId = $_POST['pedidoId'];

// Actualizar el estado de la mesa a 'libre'
$consultaMesa = "UPDATE mesas SET estado=0 WHERE codigo='$mesaId'";
mysqli_query($conn, $consultaMesa);

// Actualizar el estado del pedido a 'pagado'
$consultaPedido = "UPDATE pedidos SET pagado=1, mesa=NULL WHERE id='$pedidoId'";

mysqli_query($conn, $consultaPedido);

header("LOCATION:salon.php");
?>