<?php 
	require_once('../Models/VentasModel.php');

	// en caso de una venta
	if(isset($_GET['codigoProducto']))
	{
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
	}

	// en caso de producto vender, cambiar este producto por el de la devolucion
	if(isset($_GET['codigoProductoVender']))
	{
		$codigoProducto = $_GET['codigoProductoVender'];
		$inst = new Ventas();

		$Producto = $inst->getProductoAjax($codigoProducto);

		if($Producto){
			echo "<select id='idProductoNuevo' name='idProductoNuevo' class='form-control' required>";
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
	}	
 ?>