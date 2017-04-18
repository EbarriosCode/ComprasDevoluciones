<?php 
	require_once('../Models/DevolucionesModel.php');
	$inst = new Devoluciones();

	if(isset($_POST['devolver-producto']))
	{
		$documento = $_POST['documento'];
		$idProducto = $_POST['idProductoDevolver'];
		$cantidadProducto = $_POST['cantidadProducto'];
		$idCliente = $_POST['idCliente'];

		$devolvido = $inst->DevolverProducto($documento,$idProducto,$cantidadProducto,$idCliente);
		if($devolvido){
			echo "<script>alert('Devolución Registrada Correctamente');";
			echo "window.location.href='DevolucionesController.php'</script>";
		}
		else{
			echo "<script>alert('No se guardo el registro');";
			echo "window.location.href='DevolucionesController.php'</script>";
		} 
	}

	require_once('../Views/DevolucionesView.php');
 ?>