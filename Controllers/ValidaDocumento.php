<?php 
	require_once('../Models/DevolucionesModel.php');
	$inst = new Devoluciones();
	$factura = $_GET['NoDocumento'];

	$existeFactura = $inst->ExisteFactura($factura);
	//var_dump($existeFactura);

	if($existeFactura)
	{
		foreach($existeFactura as $item)
		{
			echo "<label class='label label-info'>La Factura # ".$item['idVenta']." si existe y la venta se realizo en fecha ".$item['fecha'].".  Hace ".$item['diferencia']." Dias </label>";	
		}
	}
	else
	{
		echo "<label class='label label-danger'>Esta Factura no Existe en la Base de Datos, no hay ninguna venta relacionada al # de factura ".$factura."</label>";
		echo "<script>";
				echo "$('#alerta').show();";
				//echo "$('#alerta').fadeIn(8000);";				
				echo "$('#devolver').attr('disabled',true);";
		echo "</script>";	
	}
 ?>