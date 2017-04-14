<?php 
	require_once('../Models/ProductosModel.php');

	$inst = new Productos();
	//$Productos = $inst->getProductos(0,5);
	$Marcas = $inst->getMarcas();

	// Inicia paginación
	$cant_filas = new Productos();
	$pagination = new Productos();	
	$no_registros = 5;

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
	
	$Productos = $pagination->getProductos($nuevo_inicio,$no_registros);
	
	$total_registros = count($cant_filas->numRegistros());
	$total_paginas = ceil($total_registros/$no_registros);

	//var_dump($Asignados);
	// fin paginación

	if(isset($_POST['editar-productos']))
	{
		$idProducto = $_POST['idProducto'];
		$codigoProducto = $_POST['codigoProducto'];
		$producto = $_POST['productoEditar'];
		$descripcion = $_POST['descripcionEditar'];
		$precio = $_POST['precioEditar'];
		$costo = $_POST['costoEditar'];
		$existencia = $_POST['existenciaEditar'];
		$idMarca = $_POST['marcaEditar'];

		$editado = $inst->updateProductos($idProducto,$codigoProducto,$producto,$descripcion,$precio,$costo,$existencia,$idMarca);
		if($editado){
			echo "<script>alert('Registro Actualizado Correctamente');";
			echo "window.location.href='ProductosController.php'</script>";
		}
		else{
			echo "<script>alert('No se actualizo el registro');";
			echo "window.location.href='ProductosController.php'</script>";
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
			}
		}
	}
	
	require_once('../Views/ProductosView.php');

 ?>