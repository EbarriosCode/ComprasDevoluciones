<?php 
	require_once('../Models/VentasModel.php');

	$nit = $_GET['nit'];
	$inst = new Ventas();

	$Cliente = $inst->getClienteAjax($nit);

	if($Cliente){
		echo "<select id='idCliente' name='idCliente' class='form-control' required>";
		foreach($Cliente as $item){	
				echo "<option value='$item[idCliente]'>".$item['nombreCliente']."</option>";
		}
		echo "</select>";
	}
	else{
		echo "<label class='label label-danger'>No existe ningún Cliente con ese nit, ingrese un NIT válido para activar los elementos que desaparecieron</label>";
		echo "<style>";						
					echo "#crear{ display: none; }";	
			echo "</style>";
	}

 ?>