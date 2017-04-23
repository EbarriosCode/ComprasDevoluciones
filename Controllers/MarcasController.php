<?php 
	require_once('../Models/MarcasModel.php');

	$inst = new Marcas();
	
	// Inicia paginación
	$cant_filas = new Marcas();
	$pagination = new Marcas();	
	$no_registros = 10;

	if(isset($_GET['pagina']))
	 {
		if($_GET['pagina'] == 1)
		{
			header("Location:ProductosController.php");
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
	
	$Marcas = $pagination->getMarcas($nuevo_inicio,$no_registros);
	
	$total_registros = count($cant_filas->numRegistros());
	$total_paginas = ceil($total_registros/$no_registros);

	//var_dump($Asignados);
	// fin paginación

	if(isset($_POST['editar-marcas']))
	{
		$idMarca = $_POST['idMarca'];
		$marca = $_POST['marca'];
		
		$editado = $inst->updateMarcas($idMarca,$marca);
		if($editado){
			echo "<script>alert('Registro Actualizado Correctamente');";
			echo "window.location.href='MarcasController.php'</script>";
		}
		else{
			echo "<script>alert('No se actualizo el registro');";
			echo "window.location.href='MarcasController.php'</script>";
		}
	}

	// eliminar un producto
	if(isset($_GET['accion']))
	{
		if(strcmp($_GET['accion'],"borrar") == 0 ){
			$idProducto = $_GET['idProducto'];



			$bool = $inst->deleteProductos($idProducto);
			if ($bool) {
				echo "<script>alert('Registro Borrado Correctamente');";
				echo "window.location.href='ProductosController.php'</script>";
			}
			else
			{
				echo "<script>alert('No se borro ningún registro');";
				echo "window.location.href='ProductosController.php'</script>";
			}
		}
	}
	
	require_once('../Views/MarcasView.php');

 ?>