<?php 
	require_once('../Models/ClientesModel.php');
	$inst = new Clientes();

	$idDepartamento = $_GET['idDepartamento'];
	$Municipios = $inst->getMunicipiosAjax($idDepartamento);

	echo "<select class='form-control' id='idMunicipio' name='idMunicipio'>";
		echo "<option value='0'>Selecciona:</option>";		
		foreach($Municipios as $item)
		{		
			echo "<option value='$item[idMunicipio]'>".$item['nombreMunicipio']."</option>";		
		}
	echo "</select>";

 ?>