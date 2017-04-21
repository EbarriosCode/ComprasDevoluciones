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
			echo "<label class='label label-danger'>No existe ningún Producto con ese código, ingrese un código válido para activar los elementos que desaparecieron</label>";			
			echo "<style>";	
					echo "#cantidadProducto{ display: none; }";	
					echo "#crear{ display: none; }";	
			echo "</style>";
		}
	}

	// en caso de producto vender, cambiar este producto por el de la devolucion
	if(isset($_GET['codigoProductoVender']))
	{
		$codigoProducto = $_GET['codigoProductoVender'];
		$inst = new Ventas();

		$Producto = $inst->getProductoAjax($codigoProducto);

		if($Producto){
			
			foreach($Producto as $item){
				echo "<select id='idProductoNuevo' name='idProductoNuevo' class='form-control' required>";	
						echo "<option value='$item[idProducto]'>".$item['nombreProducto']." Marca ".$item['nombreMarca']." Precio Unitario Q.".$item['precio']."</option>";	
						echo "</select>";
				echo "<input type='hidden' id='existenciaDB' name='existenciaDB' value='$item[existencia]'/>";		
				echo "<label class='label label-primary'>Cantidad en existencia ".$item['existencia']."</label>";

				//echo "<input type='hidden' id='productoNuevoVender' value='".$codigoProducto."' />";
						
			}
			

		}
		else{
			echo "<label class='label label-danger'>No existe ningún Producto con ese código, ingrese un código válido para activar los elementos que desaparecieron</label>";			
			echo "<style>";	
					echo "#cantidadProductoNuevo{ display: none; }";	
					echo "#devolver{ display: none; }";	
			echo "</style>";
		}
	}	
 ?>