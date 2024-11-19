<?php
include "../conexion.php";
include "../sesion.php";

/* Change to the correct path if you copy this example! */
require __DIR__ . '../vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

/* Most printers are open on port 9100, so you just need to know the IP 
 * address of your receipt printer, and then fsockopen() it on that port.
 */
try {
    // AQUI ponemos ip de la impresora (la que le demos)
    $connector = new NetworkPrintConnector("10.x.x.x", 9100);

    // dejamos tal cual 
    $printer = new Printer($connector);

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