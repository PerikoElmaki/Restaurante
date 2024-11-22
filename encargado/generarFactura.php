<?php
include "sesionEncargado.php";
include "../conexion.php";
require '../vendor/composer/autoload.php';
require('fpdf/fpdf.php'); // Asegúrate de que la ruta es correcta

if (isset($_POST['fecha'])) {
    $fecha = $_POST['fecha'];
    
    // Consulta para obtener los pedidos del día
    $queryPedidos = "SELECT * FROM pedidos WHERE DATE(fecha) = ?";
    $stmtPedidos = $conn->prepare($queryPedidos);
    $stmtPedidos->bind_param("s", $fecha);
    $stmtPedidos->execute();
    $resultPedidos = $stmtPedidos->get_result();

    // Consulta para obtener la suma del total de todos los pedidos
    $queryTotal = "SELECT SUM(total) as total_dia FROM pedidos WHERE DATE(fecha) = ?";
    $stmtTotal = $conn->prepare($queryTotal);
    $stmtTotal->bind_param("s", $fecha);
    $stmtTotal->execute();
    $resultTotal = $stmtTotal->get_result();
    $totalDia = $resultTotal->fetch_assoc()['total_dia'];

    // Consulta para obtener el total de productos pedidos
    $queryProductos = "SELECT SUM(cant) as total_productos FROM lineas_pedidos lp JOIN pedidos p ON lp.pedido = p.id WHERE DATE(p.fecha) = ?";
    $stmtProductos = $conn->prepare($queryProductos);
    $stmtProductos->bind_param("s", $fecha);
    $stmtProductos->execute();
    $resultProductos = $stmtProductos->get_result();
    $totalProductos = $resultProductos->fetch_assoc()['total_productos'];

    // Crear una instancia de FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    // Título
    $pdf->Cell(0, 10, 'Facturas del dia ' . $fecha, 0, 1, 'C');

    // Encabezados de la tabla
    $pdf->Cell(40, 10, 'Pedido ID', 1);
    $pdf->Cell(60, 10, 'Fecha', 1);
    $pdf->Cell(40, 10, 'Total', 1);
    $pdf->Ln();

    // Procesar cada fila de pedidos
    while ($row = $resultPedidos->fetch_assoc()) {
        $pdf->Cell(40, 10, $row['id'], 1);
        $pdf->Cell(60, 10, $row['fecha'], 1);
        $pdf->Cell(40, 10, $row['total'], 1);
        $pdf->Ln();
    }

    // Mostrar el total del día y el total de productos pedidos
    $pdf->Ln();
    $pdf->Cell(0, 10, 'Total del dia: ' . number_format($totalDia, 2) . ' EUR', 0, 1, 'R');
    $pdf->Cell(0, 10, 'Total de productos pedidos: ' . $totalProductos, 0, 1, 'R');

    $stmtPedidos->close();
    $stmtTotal->close();
    $stmtProductos->close();
    $conn->close();

    // Salida del PDF
    $pdf->Output('D', 'facturas_' . $fecha . '.pdf');
} else {
    echo "No se ha recibido la fecha.";
}
?>