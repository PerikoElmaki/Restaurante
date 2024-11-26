<?php
include "sesionEncargado.php";
include "../conexion.php";

require('../vendor/setasign/fpdf/fpdf.php'); // Asegúrate de que la ruta es correcta



if (isset($_POST['fecha'])) {
    // Consulta de productos de esa fecha
    $fecha = $_POST['fecha'];
    $fecha = date('Y-m-d', strtotime($fecha));
    $consulta = "SELECT * FROM pedidos WHERE fecha = '$fecha'";

    $resultado = mysqli_query($conn, $consulta);

    // COnsulta del total de todos los productos del dia
    $totalProductosVendidos = 0;
    
    $consultaLineas = "SELECT SUM(cant) as totalCantidad FROM lineas_pedidos WHERE pedido IN (SELECT id FROM pedidos WHERE fecha = '$fecha' AND eliminado = 0)";
    $resultadoLineas = mysqli_query($conn, $consultaLineas);
    $filaLineas = mysqli_fetch_array($resultadoLineas);
    $totalProductosVendidos = $filaLineas['totalCantidad'];

    // Consulta del producto más vendido del día
    $consultaProductoMasVendido = "SELECT producto, SUM(cant) as totalCantidad FROM lineas_pedidos WHERE pedido IN (SELECT id FROM pedidos WHERE fecha = '$fecha' AND eliminado = 0) GROUP BY producto ORDER BY totalCantidad DESC LIMIT 1";
    $resultadoProductoMasVendido = mysqli_query($conn, $consultaProductoMasVendido);
    $filaProductoMasVendido = mysqli_fetch_array($resultadoProductoMasVendido);
    $productoMasVendidoId = $filaProductoMasVendido['producto'];
    $totalCantidadProductoMasVendido = $filaProductoMasVendido['totalCantidad'];

    $consultaNombreProducto = "SELECT nombre FROM productos WHERE id = '$productoMasVendidoId'";
    $resultadoNombreProducto = mysqli_query($conn, $consultaNombreProducto);
    $filaNombreProducto = mysqli_fetch_array($resultadoNombreProducto);
    $nombreProductoMasVendido = $filaNombreProducto['nombre'];


    mysqli_data_seek($resultado, 0); // Reiniciar el puntero del resultado





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
        $eliminado = $fila['eliminado'];

        if($eliminado == 0){
            $pdf->Cell(40, 10, '   ' . $id, 1);
            $pdf->Cell(60, 10, '   ' . $hora, 1);
            $pdf->Cell(40, 10, '   ' . $total . ' EUR', 1);
            $pdf->Ln();
        }
      
    }

    // Encabezados de la tabla para pedidos eliminados
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Pedidos Eliminados', 0, 1, 'C');
    $pdf->SetX(($pdf->GetPageWidth() - 140) / 2);
    $pdf->Cell(40, 10, '    Pedido ID', 1);
    $pdf->Cell(60, 10, '    Hora', 1);
    $pdf->Cell(40, 10, '    Total', 1);
    $pdf->Ln();

    // Procesar cada fila de pedidos eliminados
    mysqli_data_seek($resultado, 0); // Reiniciar el puntero del resultado
    while ($fila = mysqli_fetch_array($resultado)) {
        $pdf->SetX(($pdf->GetPageWidth() - 140) / 2);
        $id = $fila['id'];
        $total = $fila['total'];
        $hora = $fila['hora'];
        $eliminado = $fila['eliminado'];

        if ($eliminado == 1) {
            $pdf->Cell(40, 10, '   ' . $id, 1);
            $pdf->Cell(60, 10, '   ' . $hora, 1);
            $pdf->Cell(40, 10, '   ' . $total . ' EUR', 1);
            $pdf->Ln();
        }
    }

    // Calcular el total de ingresos del día
    $totalIngresos = 0;
    mysqli_data_seek($resultado, 0); // Reiniciar el puntero del resultado
    while ($fila = mysqli_fetch_array($resultado)) {
        if($fila['eliminado']==0){

            $totalIngresos += $fila['total'];
        }
    }

    // Calcular la media de total de cuentas
    $numeroPedidos = mysqli_num_rows($resultado);
    $mediaTotalCuentas = $numeroPedidos > 0 ? $totalIngresos / $numeroPedidos : 0;

    // Mostrar la media de total de cuentas
    $pdf->Ln(5);
    $pdf->Cell(0, 10, 'Media de cuentas: ' . number_format($mediaTotalCuentas, 2) . ' EUR', 0, 1, 'C');
    // Mostrar el total de ingresos
    $pdf->Cell(0, 10, 'Producto + vendido: ' . $nombreProductoMasVendido, 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0, 10, 'Productos vendidos: ' . $totalProductosVendidos . ' unidades', 0, 1, 'C');
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