<?php 
	ob_start();
	// obtenemos el numero de la factura que es el mismo idVenta
	$NoDocumento = $_GET['noFactura'];

	require_once('../Models/NotaCreditoDevolucionDineroModel.php');
	$inst = new NotaCredito();
	$NotaCredito = $inst->getNotaCredito($NoDocumento);
	
	// incluir la vista que es lo que se vera en el pdf con datos de la factura	
	require_once('../Views/NotaCreditoDevolucionDineroView.php');

	// esta sección crea un pdf de la factura
	require_once('../LibraryPDF/dompdf/dompdf_config.inc.php');
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();

	$pdf = $dompdf->output();
	$filename = "NotaCreditoDevolucion-".$NoDocumento.".pdf";
	$dompdf->stream($filename,array("Attachment" => 0));
 ?>