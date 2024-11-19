<?php


/* Change to the correct path if you copy this example! */
require __DIR__ . '/../vendor/autoload.php';

use Mike42\Escpos\Printer;
// para con internet
// use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
// este para usb
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

include "crearPedido.php";

try {
    // AQUI ponemos ip de la impresora (la que le demos) si es por internet
    // $connector1 = new NetworkPrintConnector("10.x.x.x", 9100);

    // sergunco conector para usb 
    $connector2 = new WindowsPrintConnector("USB001");

    // o usamoa connector1 
    $printer = new Printer($connector2);

    // Config inicial
    $printer->setPrintLeftMargin(0);
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setTextSize(1, 1);


// comentarios no van
  

    $items = [];

    for ($i = 0; $i < count($nombresProductos); $i++) {
        $items[] = [
            "descripcion" => $nombresProductos[$i],
            "cantidad" => $cantidades[$i],
            "comentario" => $comentarios[$i]
        ];
    }
    // Encabezado del ticket
    $printer->feed(1);
    $printer->setEmphasis(true);
    $printer->setTextSize(2, 2);
    $printer->text("COCINA BRESCIANO'S\n");
    $printer->setTextSize(1, 1);
    $printer->feed(1);

    $printer->setEmphasis(false);
    $printer->text("Fecha: " . date("d-m-Y") . "\n");
    $printer->feed(2);

    $printer->setEmphasis(true);
    $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $printer->text("Hora: " . date("H:i:s") . "\n");
    $printer->setEmphasis(false);

    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->setEmphasis(true);
    $printer->setTextSize(2, 2);
    $printer->text("Mesa:$mesaId\n");
    $printer->setTextSize(1, 1);
    $printer->text("Camarero:$nombre\n");
    $printer->setEmphasis(false);
    $printer->text("------------------------------------------------\n");

    // Detalles de la cuenta
    //array 
    
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    foreach ($items as $item) {
        $printer->text($item["descripcion"] . " x " . $item["cantidad"] . " -  " . $item["comentario"] . "\n");
    }

    $printer->text("------------------------------------------------\n");
    $printer->setJustification(Printer::JUSTIFY_RIGHT);







    // corta al final
    $printer->cut();

    /* Close printer */
    $printer->close();
    header("LOCATION:salon.php");
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}
