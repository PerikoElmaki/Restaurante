<?php
include "../sesion.php";
include "../conexion.php";

// Otra comprobación para que no se pueda acceder a esta sección 
// Comprobar si el camarero es encargado
$nombre = $_SESSION['nombre'];
$consultaEncargado = "SELECT encargado FROM camareros WHERE nombre = '$nombre'";
$resultadoEncargado = mysqli_query($conn, $consultaEncargado);
if ($resultadoEncargado && mysqli_num_rows($resultadoEncargado) > 0) {
    $filaEncargado = mysqli_fetch_assoc($resultadoEncargado);
    $esEncargado = $filaEncargado['encargado'];
} else {
    $esEncargado = 0; // Asumimos que no es encargado si no se encuentra en la base de datos
}

$pedidoId = $_GET['pedidoId'];
$mesaId = $_GET['mesaId'];
if ($esEncargado == 1) {
$consultaEliminar = "UPDATE pedidos SET eliminado = 1 WHERE id = '$pedidoId'";

if (mysqli_query($conn, $consultaEliminar)) {
    echo "Pedido eliminado correctamente.";
    $consultaActualizarMesa = "UPDATE mesas SET estado = 0 WHERE codigo = '$mesaId'";
    mysqli_query($conn, $consultaActualizarMesa);
    header("Location: salon.php");
} else {
    echo "Error al eliminar el pedido: " . mysqli_error($conn);
}
} else {
    echo "No tienes permisos para eliminar pedidos.";
}


?>