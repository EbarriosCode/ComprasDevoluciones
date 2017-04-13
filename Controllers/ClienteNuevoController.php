<?php
	require_once('../Models/ClientesModel.php'); 

	$inst = new Clientes();
	$Municipios = $inst->getMunicipios();

	if(isset($_POST['insertar-cliente']))
	{
		$cliente = $_POST['cliente'];
		$nit = $_POST['nit'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$idMunicipio = $_POST['idMunicipio'];		

		$insertado = $inst->insertClientes($cliente,$nit,$direccion,$telefono,$idMunicipio);
		if($insertado){
			echo "<script>alert('Registro Guardado Correctamente');";
			echo "window.location.href='ClientesController.php'</script>";
		}
		else{
			echo "<script>alert('No se guardo el registro');";
			echo "window.location.href='ClientesController.php'</script>";
		}
	}
	require_once('../Views/ClienteNuevoView.php');
	
 ?>