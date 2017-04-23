<?php 
	require_once('../Models/MarcasModel.php');
	$inst = new Marcas();

	if(isset($_POST['insertar-marca']))
	{
		$nombreMarca = $_POST['marca'];

		$insertado = $inst->insertMarcas($nombreMarca);
		if($insertado)
		{
			echo "<script>alert('Registro Guardado Correctamente');";
			echo "window.location.href ='MarcasController.php'</script>";
		}
		else
		{
			echo "<script>alert('No se Guardo el registro');";
			echo "window.location.href = 'MarcasController.php'</script>";	
		}
	}	

	require_once('../Views/MarcaNuevaView.php');
 ?>