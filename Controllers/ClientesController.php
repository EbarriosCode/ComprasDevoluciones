<?php 
	require_once('../Models/ClientesModel.php');
	$inst = new Clientes();	
	$Municipios = $inst->getMunicipios();
	// Inicia paginación
	$cant_filas = new Clientes();
	$pagination = new Clientes();	
	$no_registros = 5;

	if(isset($_GET['pagina']))
	 {
		if($_GET['pagina'] == 1)
		{
			header("Location:ClientesController.php");
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
	
	$Clientes = $pagination->getClientes($nuevo_inicio,$no_registros);
	
	$total_registros = count($cant_filas->numRegistros());
	$total_paginas = ceil($total_registros/$no_registros);

	// fin paginación

	if(isset($_POST['editar-cliente']))
	{
		$idCliente = $_POST['idClienteEditar'];
		$cliente = $_POST['clienteEditar'];
		$nit = $_POST['nitEditar'];
		$telefono = $_POST['telefonoEditar'];
		$direccion = $_POST['direccionEditar'];		
		$idMunicipio = $_POST['municipioEditar'];

		$editado = $inst->updateClientes($idCliente,$cliente,$nit,$direccion,$telefono,$idMunicipio);
		if($editado){
			echo "<script>alert('Registro Actualizado Correctamente');";
			echo "window.location.href='ClientesController.php'</script>";
		}
		else{
			echo "<script>alert('No se actualizo el registro');";
			echo "window.location.href='ClientesController.php'</script>";
		}
	}

	// eliminar un cliente
	if(isset($_GET['accion']))
	{
		if(strcmp($_GET['accion'],"borrar") == 0 ){
			$idCliente = $_GET['idCliente'];

			$bool = $inst->deleteClientes($idCliente);
			if ($bool) {
				echo "<script>alert('Registro Borrado Correctamente');";
				echo "window.location.href='ClientesController.php'</script>";
			}
			else
			{
				echo "<script>alert('No se borro ningún registro');";
			}
		}
	}
	require_once('../Views/ClientesView.php');
 ?>