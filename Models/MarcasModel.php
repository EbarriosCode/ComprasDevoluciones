<?php 
	require_once('Conexion.php');

	class Marcas extends Conexion
	{
	
		public function getMarcas($inicio=false,$no_registros=false)
		{ 	
			if($inicio!==false && $no_registros!==false)
			{
				$sql = "SELECT idMarca,nombreMarca FROM marcaproductos 
					    	ORDER BY idMarca DESC LIMIT $inicio,$no_registros";
			}
			else{
				$sql = "SELECT idMarca,nombreMarca FROM marcaproductos 
					    	ORDER BY idMarca DESC";
			}

			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function numRegistros()
		{
			$sql = "SELECT idMarca FROM marcaproductos";
			$resultado = Conexion::Conectar()->prepare($sql);
			$resultado->execute();
			return $resultado->fetchAll();			 
		}

		public function insertMarcas($nombreMarca)
		{
			$sql = "INSERT INTO marcaproductos(nombreMarca) VALUES(?)";
			$stmt = Conexion::Conectar()->prepare($sql);

			if($stmt->execute(array($nombreMarca)))
				return true;

			else
				return false;

			$stmt->close();
		}

		public function updateMarcas($idMarca,$nombreMarca)
		{
			$sql = "UPDATE marcaproductos SET nombreMarca='$nombreMarca' WHERE idMarca=$idMarca";
			$stmt = Conexion::Conectar()->prepare($sql);

			if($stmt->execute())
				return true;

			else
				return false;

			$stmt->close();	
		}
	}

	/*$r = new Productos();
	echo sizeof($r->numRegistros());*/
 ?>