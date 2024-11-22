<?php
include "sesionEncargado.php";
include "../conexion.php";

require('../vendor/setasign/fpdf/fpdf.php'); // Asegúrate de que la ruta es correcta



if (isset($_POST['fecha'])) {
    $fecha = $_POST['fecha'];
    $fecha = date('Y-m-d', strtotime($fecha));
    $consulta = "SELECT * FROM pedidos WHERE fecha = '$fecha'";

    $resultado = mysqli_query($conn, $consulta);

    

    // Crear una instancia de FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    // Título
    $pdf->Cell(0, 10, 'NAM NAM Rubio Lujan ', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Pedidos del dia ' . $fecha, 0, 1, 'C');

    // Encabezados de la tabla
    $pdf->SetX(($pdf->GetPageWidth() - 140) / 2);
    $pdf->Cell(40, 10, '    Pedido ID', 1);
    $pdf->Cell(60, 10, '    Hora', 1);
    $pdf->Cell(40, 10, '    Total', 1);
    $pdf->Ln();

    // Procesar cada fila de pedidos
    while ($fila = mysqli_fetch_array($resultado)) {
        $pdf->SetX(($pdf->GetPageWidth() - 140) / 2);
        $id = $fila['id'];
        $total= $fila['total'];
        $hora = $fila['hora'];

        
        $pdf->Cell(40, 10,'   '. $id, 1);
        $pdf->Cell(60, 10,'   ' . $hora , 1);
        $pdf->Cell(40, 10,'   ' . $total . ' EUR', 1);
       
       
        $pdf->Ln();
    }

    // Calcular el total de ingresos del día
    $totalIngresos = 0;
    mysqli_data_seek($resultado, 0); // Reiniciar el puntero del resultado
    while ($fila = mysqli_fetch_array($resultado)) {
        $totalIngresos += $fila['total'];
    }

    // Mostrar el total de ingresos
    $pdf->Ln(10);
  
    
    $pdf->Cell(0, 10,'Total de ingresos del dia: ' . $totalIngresos . ' EUR', 0, 1, 'C');
    $conn->close();

    // Salida del PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="pedidos_' . $fecha . '.pdf"');
    $pdf->Output('I', 'pedidos_' . $fecha . '.pdf');
} else {
    echo "No se ha recibido la fecha.";
}
?>