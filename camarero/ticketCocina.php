<?php
include "../sesion.php";
include "../conexion.php";

/* Change to the correct path if you copy this example! */
require __DIR__ . '/../vendor/autoload.php';

use Mike42\Escpos\Printer;
// para con internet
// use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
// este para usb
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$nombre = $_SESSION['nombre'];
$mesaId = $_GET['mesaId'];

// Obtener el ID del pedido desde la URL
$pedidoId = isset($_GET['pedidoId']) ? $_GET['pedidoId'] : null;
if ($pedidoId === null) {
    die("Error: id de pedido no especificado.");
}

// COnsulta pedido,
$query = "
    SELECT lp.cant AS cantidad, lp.comentario, p.nombre AS descripcion, p.categoria
    FROM lineas_pedidos lp
    JOIN productos p ON lp.producto = p.id
    WHERE lp.pedido = ?
";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Error en la consulta SQL: " . $conn->error);
}
$stmt->bind_param("i", $pedidoId);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    
        $items[] = [
            "descripcion" => $row['descripcion'],
            "cantidad" => $row['cantidad'],
            "comentario" => $row['comentario']
        ];
    
}

$stmt->close();


try {
    // AQUI ponemos ip de la impresora (la que le demos) si es por internet
    // $connector1 = new NetworkPrintConnector("10.x.x.x", 9100);
    
    // Añadiríamos otros connector según la categoría o zona

    // sergunco conector para usb 
    $connector2 = new WindowsPrintConnector("USB001");

    // o usamoa connector1 
    $printer = new Printer($connector2);

    // Config inicial
    $printer->setPrintLeftMargin(0);
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setTextSize(1, 1);




    // Encabezado del ticket
    $printer->feed(1);
    $printer->setEmphasis(true);
    $printer->setTextSize(2, 2);
    $printer->text("COCINA NAM NAM\n");
    $printer->setTextSize(1, 1);
    $printer->feed(1);

    $printer->setEmphasis(false);
    $printer->text("Fecha: " . date("d-m-Y") . "\n");
    $printer->feed(1);

    $printer->setEmphasis(true);
    $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $printer->text("Hora del pedido: " . date("H:i") . "\n");
    $printer->setEmphasis(false);

    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->setEmphasis(true);
    $printer->setTextSize(2, 2);
    $printer->text("Mesa: $mesaId\n");
    $printer->setTextSize(1, 1);
    $printer->feed(1);
    $printer->text("Camarero:  $nombre\n");
    $printer->setEmphasis(false);
    $printer->text("------------------------------------------------\n");

    // Detalles de la cuenta
    //array 
    
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    foreach ($items as $item) {
        $printer->setTextSize(2, 2);
        $printer->text($item["cantidad"] ." - " . $item["descripcion"]) . "\n";
        $printer->setTextSize(1, 1);
        $printer->text("\n--      " . $item["comentario"] . "\n");
        
    }
    $printer->setTextSize(1, 1);
    $printer->text("------------------------------------------------\n");
    $printer->setJustification(Printer::JUSTIFY_RIGHT);







    // corta al final
    $printer->cut();

    /* Close printer */
    $printer->close();
    // ahora enviamos a salon
    header("LOCATION:salon.php");
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}
