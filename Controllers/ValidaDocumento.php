<?php 
	require_once('../Models/DevolucionesModel.php');
	$inst = new Devoluciones();
	$factura = $_GET['NoDocumento'];

	$fechaDevolucion = $inst->getFechaDevolucion($factura);
	$existeFactura = $inst->ExisteFactura($factura);
	//var_dump($existeFactura);

	if($existeFactura)
	{
		foreach($existeFactura as $item)
		{
			if($item['impresoPagado'] == 2)
			{
				echo "<label class='label label-warning'>La Factura # ".$item['idVenta']." ya ha sido devuelta anteriormente, la venta se realizo fecha ".$item['fecha'].".  Hace ".$item['diferenciaDias']." Dias.</label> ";	
					echo "<br>";
					foreach($fechaDevolucion as $value){
						echo "<label class='label label-warning'>Y la fecha de vevolución fue ".$value['fechaDevolucion']."</label>";	
					}
					
				echo "<script>";
						
						echo "$('#alerta-factura-ya-devuelta').show();";
						echo "$('#alerta').hide();";	
						echo "$('#alerta-exceso-dias').hide();";		
						echo "$('#devolver').attr('disabled',true);";
						echo "$('#codigoProductoNuevo').prop('disabled',true);";
						echo "$('#cantidadProductoNuevo').prop('disabled',true);";
				echo "</script>";
			}
			else
			{
				if($item['diferenciaDias'] > 2)
				{
					echo "<script>";
					echo "$('#alerta-exceso-dias').show();";
						echo "$('#alerta-factura-ya-devuelta').hide();";
						echo "$('#alerta').hide();";			
						echo "$('#devolver').attr('disabled',true);";
					echo "</script>";
				}

				else
				{
					echo "<label class='label label-info'>La Factura # ".$item['idVenta']." existe, la venta se realizo fecha ".$item['fecha'].".  Hace ".$item['diferenciaDias']." Dias. ";
					echo "A continuación se muestran los datos pertenecientes a la factura ingresada.</label>";
					echo "<br><br>";
					echo "<div class='form-group'>						
		                        <label class='control-label col-md-3 col-sm-3 col-xs-12'>Código Producto a Devolver
		                        </label>
		                        <div class='col-md-6 col-sm-6 col-xs-12'>
		                          <input type='text' required='required' class='form-control col-md-7 col-xs-12' disabled value='".$item['codigoProducto']."'>
		                        </div>
		                  </div>
		                  <div class='form-group'>
		                        <label class='control-label col-md-3 col-sm-3 col-xs-12'>Producto a Devolver
		                        </label>
		                        <div class='col-md-6 col-sm-6 col-xs-12'>
		                          <input type='text' class='form-control col-md-7 col-xs-12' disabled value='".$item['nombreProducto']." ".$item['nombreMarca']." ".$item['descripcion']." Precio Unitario Q.".$item['precio']."'>
		                        </div>
		                        <!--Campos ocultos que poseen los valores reales para ejecutar la transaccion de devolucion-->
		                        <input type='hidden' id='documento' name='documento' value='".$item['idVenta']."'>
		                        <input type='hidden' id='idProductoDevolver' name='idProductoDevolver' value='".$item['idProducto']."'>
		                        <input type='hidden' id='cantidadProducto' name='cantidadProducto' value='".$item['cantidad']."'>
		                        <input type='hidden' id='idCliente' name='idCliente' value='".$item['idCliente']."'>
		                   </div>
		                   <div class='form-group'>
		                        <label class='control-label col-md-3 col-sm-3 col-xs-12'>Cantidad Producto a Devolver</label>
		                        <div class='col-md-6 col-sm-6 col-xs-12'>
		                          <input class='form-control col-md-7 col-xs-12' type='number' disabled value='".$item['cantidad']."'>
		                        </div>
		                      </div>";
					echo "<script>";
							echo "$('#alerta').hide();";
							echo "$('#alerta-factura-ya-devuelta').hide();";
							echo "$('#alerta-exceso-dias').hide();";			
							echo "$('#devolver').attr('disabled',false);";
							echo "$('#codigoProductoNuevo').prop('disabled',false);";
						echo "$('#cantidadProductoNuevo').prop('disabled',false);";
					echo "</script>";
				}	
			}
			
		}
	}
	else
	{
		echo "<label class='label label-danger'>Esta Factura no Existe en la Base de Datos, no hay ninguna venta relacionada al # de factura ".$factura."</label>";
		echo "<script>";
				echo "$('#alerta').show();";
				echo "$('#alerta-exceso-dias').hide();";
				echo "$('#alerta-factura-ya-devuelta').hide();";			
				echo "$('#devolver').attr('disabled',true);";
				echo "$('#codigoProductoNuevo').prop('disabled',true);";
				echo "$('#cantidadProductoNuevo').prop('disabled',true);";
		echo "</script>";	
	}
 ?>