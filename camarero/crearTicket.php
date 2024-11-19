<?php
include "../conexion.php";
include "../sesion.php";

/* Change to the correct path if you copy this example! */
require __DIR__ . '../vendor/autoload.php';
use Mike42\Escpos\Printer;
// para con internet
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
// este para usb
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


try {
    // AQUI ponemos ip de la impresora (la que le demos) si es por internet
    $connector1 = new NetworkPrintConnector("10.x.x.x", 9100);


    // sergunco conector para usb 
    $connector2 = new WindowsPrintConnector("USB001");

    // o usamoa connector1 
    $printer = new Printer($connector2);

    // Aqui imprimes cosas
    // para lineas
    $printer->text("");

    // Config inicial
    $printer->setPrintLeftMargin(0);
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setTextSize(1,1);

    





// corta al final
    $printer->cut();

    /* Close printer */
    $printer->close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}


?>