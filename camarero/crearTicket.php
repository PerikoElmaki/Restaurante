<?php
include "../conexion.php";
include "../sesion.php";

/* Change to the correct path if you copy this example! */
require __DIR__ . '/../vendor/autoload.php';
use Mike42\Escpos\Printer;
// para con internet
// use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
// este para usb
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


try {
    // AQUI ponemos ip de la impresora (la que le demos) si es por internet
    // $connector1 = new NetworkPrintConnector("10.x.x.x", 9100);


    // sergunco conector para usb 
    $connector2 = new WindowsPrintConnector("USB001");

    // o usamoa connector1 
    $printer = new Printer($connector2);

    // Aqui imprimes cosas
    
    // Config inicial
    $printer->setPrintLeftMargin(0);
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setTextSize(1,1);
    
    $mesaId =1;

    // Encabezado del ticket
    $printer->setEmphasis(true);
    $printer->text("RESTAURANTE BRESCIANO'S\n");
    

    $printer->setEmphasis(false);
    $printer->text("Fecha: " . date("d-m-Y H:i:s") . "\n");
    $printer->feed(2);

    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text("Mesa:$mesaId                 Camarero: Periko\n");
    $printer->text("------------------------------------------------\n");
    
    // Detalles de la cuenta
    $items = [
        ["descripcion" => "Hamburguesa", "cantidad" => 2, "precio" => 5.00],
        ["descripcion" => "Papas Fritas", "cantidad" => 1, "precio" => 2.50],
        ["descripcion" => "Refresco", "cantidad" => 3, "precio" => 1.50]
    ];

    foreach ($items as $item) {
        $total = $item["cantidad"] * $item["precio"];
        $printer->text($item["descripcion"] . " x" . $item["cantidad"] . " - $" . number_format($total, 2) . "\n");
    }

    $printer->text("------------------------------------------------\n");
    $printer->setJustification(Printer::JUSTIFY_RIGHT);

    // Total
    $totalCuenta = 0;
    foreach ($items as $item) {
        $totalCuenta += $item["cantidad"] * $item["precio"];
    }
    $printer->setEmphasis(true);
    $printer->text("Total: $" . number_format($totalCuenta, 2) . "\n");
    $printer->setEmphasis(false);

    $printer->setJustification(Printer::JUSTIFY_CENTER);
    // Mensaje de agradecimiento
    $printer->feed(2);
    $printer->text("Gracias por su visita\n");
    $printer->text("Vuelva pronto\n");





// corta al final
    $printer->cut();

    /* Close printer */
    $printer->close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}


?>