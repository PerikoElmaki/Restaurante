<?php
include "../conexion.php";
include "../sesion.php";

$nombre = $_SESSION['nombre'];

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
    
    // Config inicial
    $printer->setPrintLeftMargin(0);
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setTextSize(1,1);
    
  

    $productos = $_POST['productos'];
    $cantidades = $_POST['cantidades'];
    $precios = $_POST['precios'];
    $totalPedido = $_POST['totalPedido'];
    $mesaId = $_POST['mesaId'];

    $items = [];
    
    for ($i = 0; $i < count($productos); $i++) {
        $items[] = [
            "descripcion" => $productos[$i],
            "cantidad" => $cantidades[$i],
            "precio" => $precios[$i]
        ];
    }

    // Encabezado del ticket
    $printer->feed(1);
    $printer->setEmphasis(true);
    $printer->setTextSize(2, 2);
    $printer->text("RESTAURANTE NAM NAM\n");
    $printer->setTextSize(1, 1);
    $printer->feed(1);

    $printer->text("Piazza della Loggia,12\n");
    $printer->text("Brescia ,Italia\n");

    $printer->setEmphasis(false);
    $printer->text("CIF: B68942631\n");
    $printer->text("Fecha: " . date("d-m-Y H:i:s") . "\n");
    $printer->feed(1);

    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->setEmphasis(true);
    $printer->setTextSize(2, 2);
    $printer->text("Mesa:$mesaId\n");
    $printer->setTextSize(1, 1);
    $printer->feed(1);
    $printer->text("Camarero:$nombre\n");
    $printer->setEmphasis(false);
    $printer->text("------------------------------------------------\n");

    // Detalles de la cuenta
    //array 
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    foreach ($items as $item) {
        $total = $item["cantidad"] * $item["precio"];
        $printer->text($item["cantidad"] . " x " . number_format($item["precio"], 2) . "$   " .  $item["descripcion"] . " - " . number_format($total, 2) . "$\n");

        // $printer->text($item["descripcion"] . " x " . $item["cantidad"] . " -  " . number_format($total, 2) . "$\n");
        
    }

    $printer->text("------------------------------------------------\n");
    $printer->setJustification(Printer::JUSTIFY_RIGHT);

   
   
    $printer->setEmphasis(true);
    $printer->text("Importe (sin iva): " . number_format($totalPedido, 2) . "$ + ");
    
    $impuestos = $totalPedido * 0.10;
    $totalConImpuestos = $totalPedido + $impuestos;
    
    $printer->text("Base (10%): " . number_format($impuestos, 2) . "$ \n");
    $printer->feed(1);
    $printer->setTextSize(2, 2);
    $printer->text("Total : " . number_format($totalConImpuestos, 2) . "$ \n");
    $printer->setEmphasis(false);
    $printer->setTextSize(1, 1);

    $printer->setJustification(Printer::JUSTIFY_CENTER);
    // Mensaje de agradecimiento
    $printer->feed(1);
    $printer->text("Gracias por su visita\n");
    $printer->text("Vuelva pronto\n");





// corta al final
    $printer->cut();

    /* Close printer */
    $printer->close();
    header("LOCATION:salon.php");
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}


?>