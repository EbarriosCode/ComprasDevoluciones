<?php 
	ob_start();
	// obtenemos el numero de la factura que es el mismo idVenta
	$NoDocumento = $_GET['noFactura'];

	require_once('../Models/FacturaNuevaDevolucionModel.php');
	$inst = new Facturas();
	$Factura = $inst->getVenta($NoDocumento);

	// incluir la vista que es lo que se vera en el pdf con datos de la factura	
	require_once('../Views/FacturaNuevaDevolucionView.php');

	// esta sección crea un pdf de la factura
	require_once('../LibraryPDF/dompdf/dompdf_config.inc.php');
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();

	$pdf = $dompdf->output();
	$filename = "Factura-".$NoDocumento.".pdf";
	$dompdf->stream($filename,array("Attachment" => 0));
 ?>