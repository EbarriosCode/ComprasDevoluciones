<?php 
	require_once('../Models/DevolucionesModel.php');
	$inst = new Devoluciones();
	$factura = $_GET['NoDocumento'];

	$existeFactura = $inst->ExisteFactura($factura);
	//var_dump($existeFactura);

	if($existeFactura)
	{
		foreach($existeFactura as $item)
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
					//echo "$('#alerta').fadeIn(8000);";				
					echo "$('#devolver').attr('disabled',false);";
			echo "</script>";	
		}
	}
	else
	{
		echo "<label class='label label-danger'>Esta Factura no Existe en la Base de Datos, no hay ninguna venta relacionada al # de factura ".$factura."</label>";
		echo "<script>";
				echo "$('#alerta').show();";
				//echo "$('#alerta').fadeIn(8000);";				
				echo "$('#devolver').attr('disabled',true);";
		echo "</script>";	
	}
 ?>