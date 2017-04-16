<?php 
	require_once('../Models/VentasModel.php');
	$inst = new Ventas();	

	// fechas por defecto hoy para recuperar ventas
	$fechaDesde = date('Y-m-d');;
	$fechaHasta = date('Y-m-d');;

	if(isset($_POST['fecha-ventas']))
	{
		$fechaDesde = $_POST['desde'];;
		$fechaHasta = $_POST['hasta'];;		
	}
	
	// Inicia paginación
	$cant_filas = new Ventas();
	$pagination = new Ventas();	
	$no_registros = 5;

	if(isset($_GET['pagina']))
	 {
		if($_GET['pagina'] == 1)
		{
			header("Location:VentasController.php");
		}
		else{
			$inicio = $_GET['pagina'];
			//$nuevo_inicio = ($inicio-1)*$no_registros;
		}
	}
	
	if(!(isset($_GET['pagina'])))
	{
		$inicio = 1;
	}		
	
	$nuevo_inicio = ($inicio-1)*$no_registros;
	
	$Ventas = $pagination->getVentas($nuevo_inicio,$no_registros,$fechaDesde,$fechaHasta);
	
	$total_registros = count($cant_filas->numRegistros());
	$total_paginas = ceil($total_registros/$no_registros);

	//var_dump($Asignados);
	// fin paginación
	require_once('../Views/VentasView.php');
 ?>