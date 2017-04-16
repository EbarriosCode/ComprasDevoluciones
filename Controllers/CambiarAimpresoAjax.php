<?php 
	require_once('../Models/VentasModel.php');
	$inst = new Ventas();

	$idVenta = $_GET['NoDocumento'];

	$inst->setImpresoPagado($idVenta);

	
 ?>