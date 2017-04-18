<?php 
	require_once('../Models/DevolucionesModel.php');
	$inst = new Devoluciones();	

	// fechas por defecto hoy para recuperar ventas
	$fechaDesde = date('Y-m-d');;
	$fechaHasta = date('Y-m-d');;

	if(isset($_POST['fecha-ventas']))
	{
		$fechaDesde = $_POST['desde'];;
		$fechaHasta = $_POST['hasta'];;		
	}

	// Inicia paginación
	$cant_filas = new Devoluciones();
	$pagination = new Devoluciones();	
	$no_registros = 10;

	if(isset($_GET['pagina']))
	 {
		if($_GET['pagina'] == 1)
		{
			header("Location:DevolucionesController.php");
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
	
	$Devoluciones = $pagination->getDevoluciones(/*$nuevo_inicio,$no_registros,*/$fechaDesde,$fechaHasta);
	
	$total_registros = count($cant_filas->numRegistros());
	$total_paginas = ceil($total_registros/$no_registros);

	//var_dump($Asignados);
	// fin paginación
	require_once('../Views/DevolucionesView.php');
 ?>