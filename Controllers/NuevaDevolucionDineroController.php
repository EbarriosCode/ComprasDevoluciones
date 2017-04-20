<?php 

	// inclusion de archivo model devoluciones
	require_once('../Models/DevolucionesModel.php');
	$inst = new Devoluciones();

	if(isset($_POST['devolver-producto-por-dinero']))
	{
		// datos para transaccion de devolucion
		$documento = $_POST['documento-devolver'];
		$idProducto = $_POST['idProductoDevolver'];
		$cantidadProducto = $_POST['cantidadProducto'];
		$idCliente = $_POST['idCliente'];
		// FIN datos para transaccion de devolucion


		$devolvido = $inst->DevolverProducto($documento,$idProducto,$cantidadProducto,$idCliente);
		//var_dump($devolvido);


		// generar la nota de credito con el no documento a devolver
//		$notaCredito = $inst->generarNotaCredito($documento);

		if($devolvido){
			echo "<script>alert('Devolución Registrada Correctamente');";
			echo "window.location.href='DevolucionesController.php'</script>";
		}
		else{
			echo "<script>alert('No se guardo el registro');";
			echo "window.location.href='DevolucionesController.php'</script>";
		}
	}

	require_once('../Views/NuevaDevolucionDineroView.php');
 ?>