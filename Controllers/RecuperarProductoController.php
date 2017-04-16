<?php 
	require_once('../Models/VentasModel.php');

	$codigoProducto = $_GET['codigoProducto'];
	$inst = new Ventas();

	$Producto = $inst->getProductoAjax($codigoProducto);

	if($Producto){
		echo "<select id='idProducto' name='idProducto' class='form-control' required>";
		foreach($Producto as $item){	
				echo "<option value='$item[idProducto]'>".$item['nombreProducto']." Marca ".$item['nombreMarca']." Precio Unitario Q.".$item['precio']."</option>";				
		}
		echo "</select>";
		echo "<input type='hidden' id='existenciaDB' name='existenciaDB' value='$item[existencia]'/>";		
		echo "<label class='label label-primary'>Cantidad en existencia ".$item['existencia']."</label>";
	}
	else{
		echo "<label class='label label-danger'>No existe ningún Producto con ese código</label>";
	}

 ?>