<?php 
	require_once('../Models/VentasModel.php');
	
	$inst = new Ventas();

	if(isset($_POST['insertar-venta-transaccion']))
	{
        $fechaHoy = Date('Y-m-d');
        echo $fechaHoy;
		/*$producto = $_POST['producto'];
		$descripcion = $_POST['descripcion'];
		$precio = $_POST['precio'];
		$costo = $_POST['costo'];
		$existencia = $_POST['existencia'];
		$idMarca = $_POST['marca'];

		$insertado = $inst->insertProductos($codigoProducto,$producto,$descripcion,$precio,$costo,$existencia,$idMarca);
		if($insertado){
			echo "<script>alert('Registro Guardado Correctamente');";
			echo "window.location.href='ProductosController.php'</script>";
		}
		else{
			echo "<script>alert('No se actualizo el registro');";
			echo "window.location.href='ProductosController.php'</script>";
		} */
	}
	
	require_once('../Views/VentaNuevaView.php');
 ?>