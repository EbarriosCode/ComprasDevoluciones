<?php 
	require_once('../Models/VentasModel.php');

	$codigoProducto = $_GET['codigoProducto'];
	$inst = new Ventas();

	$Producto = $inst->getProductoAjax($codigoProducto);

	if($Producto){
		foreach($Producto as $item){	
				echo "<input type='text' id='producto' name='producto' required='required' value='".$item['nombreProducto']."' class='form-control' disabled>";
		}
	}
	else{
		echo "<label class='label label-danger'>No existe ningún Producto con ese código</label>";
	}

 ?>