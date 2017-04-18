<?php 
	require_once('../Models/VentasModel.php');
	
	$inst = new Ventas();


	if(isset($_POST['insertar-venta-transaccion']))
	{
        $fechaHoy = Date('Y-m-d');        
		$idCliente = $_POST['idCliente'];
		$idProducto = $_POST['idProducto'];
		$cantidad = $_POST['cantidadProducto'];
		$vieneDeDevolucion = false;
		

		$insertado = $inst->insertVentas($fechaHoy,$idCliente,$idProducto,$cantidad,$vieneDeDevolucion);
		if($insertado){
			echo "<script>alert('Registro Guardado Correctamente');";
			echo "window.location.href='VentasController.php'</script>";
		}
		else{
			echo "<script>alert('No se guardo el registro');";
			echo "window.location.href='VentasController.php'</script>";
		} 
	}
	
	require_once('../Views/VentaNuevaView.php');
 ?>