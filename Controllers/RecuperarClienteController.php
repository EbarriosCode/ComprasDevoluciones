<?php 
	require_once('../Models/VentasModel.php');

	$nit = $_GET['nit'];
	$inst = new Ventas();

	$Cliente = $inst->getClienteAjax($nit);

	if($Cliente){
		foreach($Cliente as $item){	
				echo "<input type='text' id='cliente' name='cliente' required='required' value='".$item['nombreCliente']."' class='form-control' disabled>";
		}
	}
	else{
		echo "<label class='label label-danger'>No existe ningún Cliente con ese nit</label>";
	}

 ?>