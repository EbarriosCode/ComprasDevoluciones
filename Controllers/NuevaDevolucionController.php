<?php 
	// inclusion de archivo model para generar la nueva venta y nueva factura
	require_once('../Models/VentasModel.php');
	$obj = new Ventas();

	// inclusion de archivo model devoluciones
	require_once('../Models/DevolucionesModel.php');
	$inst = new Devoluciones();

	if(isset($_POST['devolver-producto']))
	{
		// datos para transaccion de devolucion
		$documento = $_POST['documento-devolver'];
		$idProducto = $_POST['idProductoDevolver'];
		
		if($_POST['cantidadProducto'] == 1)
			$cantidadProducto = $_POST['cantidadProducto'];
		else
			$cantidadProducto = $_POST['cantProductoDevolver'];
		$idCliente = $_POST['idCliente'];
		// FIN datos para transaccion de devolucion

		// datos para generar la nueva venta y factura
		$fecha = DATE('Y-m-d');
		$idProductoNuevo = $_POST['idProductoNuevo'];
		$cantidadProductoNuevo = $_POST['cantidadProductoNuevo'];
		$vieneDeDevolucion = true;
		// FIN datos para generar la nueva venta y factura
		$devolvido = $inst->DevolverProducto($documento,$idProducto,$cantidadProducto,$idCliente);
		//var_dump($devolvido);
		$nuevaVentaFactura = $obj->insertVentas($fecha,$idCliente,$idProductoNuevo,$cantidadProductoNuevo,$vieneDeDevolucion);

		// generar la nota de credito con el no documento a devolver
		$notaCredito = $inst->generarNotaCredito($documento);

		if($devolvido && $nuevaVentaFactura && $notaCredito){
			echo "<script>alert('Devolución Registrada Correctamente');";
			echo "window.location.href='DevolucionesController.php'</script>";
		}
		else{
			echo "<script>alert('No se guardo el registro');";
			echo "window.location.href='DevolucionesController.php'</script>";
		}
	}

	require_once('../Views/NuevaDevolucionView.php');
 ?>