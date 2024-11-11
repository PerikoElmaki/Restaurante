<!-- Consulta con bbdd que genera un json con los productos -->
<?php
include "../conexion.php";
include "../sesion.php";

// Consulta para obtener productos con stock > 0
$consulta = "SELECT * FROM productos";

// Ejecutamos la consulta
$resultado = mysqli_query($conn, $consulta);

// Verificamos si hay resultados
if (!$resultado) {
    echo json_encode(["error" => "Error en la consulta: " . mysqli_error($conn)]);
    exit();
}

// Creamos un array para almacenar los productos
$productos = array();

// Iteramos sobre los resultados y los agregamos al array
while ($fila = mysqli_fetch_assoc($resultado)) {
    // Cada producto es un array asociativo con los campos del producto
    $productos[] = [
        "id" => $fila['id'],
        "nombre" => $fila['nombre'],
        "categoria"=>$fila['categoria'],
        "precio" => $fila['precio'],
        "stock" => $fila['stock']
    ];
}

// Transformamos el array de productos a formato JSON
$json_productos = json_encode($productos);

// Configuramos la cabecera para devolver el JSON
header('Content-Type: application/json');
echo $json_productos;
?>