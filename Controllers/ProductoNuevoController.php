<?php
	require_once('../Models/ProductosModel.php'); 

	$inst = new Productos();
	$Marcas = $inst->getMarcas();

	if(isset($_POST['insertar-producto']))
	{
		$producto = $_POST['producto'];
		$descripcion = $_POST['descripcion'];
		$precio = $_POST['precio'];
		$costo = $_POST['costo'];
		$existencia = $_POST['existencia'];
		$idMarca = $_POST['marca'];

		$insertado = $inst->insertProductos($producto,$descripcion,$precio,$costo,$existencia,$idMarca);
		if($insertado){
			echo "<script>alert('Registro Guardado Correctamente');";
			echo "window.location.href='ProductosController.php'</script>";
		}
		else{
			echo "<script>alert('No se actualizo el registro');";
			echo "window.location.href='ProductosController.php'</script>";
		}
	}
	require_once('../Views/ProductoNuevoView.php');
	
 ?>