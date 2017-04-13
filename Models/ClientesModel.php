<?php 
	require_once('Conexion.php');
	class Clientes extends Conexion
	{
		public function getClientes($inicio=false,$no_registros=false)
		{ 	
			if($inicio!==false && $no_registros!==false)
			{
				$sql = "SELECT C.idCliente,C.nombreCliente,C.nit,C.direccion,C.telefono,C.idMunicipio,M.nombreMunicipio,D.nombreDepartamento
						FROM clientes C
						INNER JOIN municipio M ON M.idMunicipio=C.idMunicipio
						INNER JOIN departamento D ON M.idDepartamento=D.idDepartamento
						ORDER BY C.idCliente DESC LIMIT $inicio,$no_registros";
			}
			else{
				$sql = "SELECT C.idCliente,C.nombreCliente,C.nit,C.direccion,C.telefono,C.idMunicipio,M.nombreMunicipio,M.idMunicipio,D.nombreDepartamento
						FROM clientes C
						INNER JOIN municipio M ON M.idMunicipio=C.idMunicipio
						INNER JOIN departamento D ON M.idDepartamento=D.idDepartamento
						ORDER BY C.idCliente DESC";	
			}

			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
	}

	public function numRegistros()
		{
			$sql = "SELECT idCliente FROM clientes";
			$resultado = Conexion::Conectar()->prepare($sql);
			$resultado->execute();
			return $resultado->fetchAll();			 
		}

		public function insertClientes($cliente,$nit,$direccion,$telefono,$idMunicipio)
		{
			$sql = "INSERT INTO clientes(nombreCliente,nit,direccion,telefono,idMunicipio) VALUES(?,?,?,?,?)";
			$stmt = Conexion::Conectar()->prepare($sql);

			if($stmt->execute(array($cliente,$nit,$direccion,$telefono,$idMunicipio)))
				return true;

			else
				return false;

			$stmt->close();
		}

		public function updateClientes($idCliente,$cliente,$nit,$direccion,$telefono,$idMunicipio)
		{
			$sql = "UPDATE clientes SET nombreCliente='$cliente',nit='$nit',direccion='$direccion',telefono=$telefono,idMunicipio=$idMunicipio WHERE idCliente=$idCliente";
			$stmt = Conexion::Conectar()->prepare($sql);

			if($stmt->execute())
				return true;

			else
				return false;

			$stmt->close();	
		}

		public function deleteClientes($idCliente)
		{
			$sql = "DELETE FROM clientes WHERE idCliente=$idCliente";
			$stmt = Conexion::Conectar()->prepare($sql);

			if($stmt->execute())
				return true;

			else
				return false;

			$stmt->close();		
		}

		public function getDepartamentos()
		{
			$sql = "SELECT idDepartamento,nombreDepartamento FROM departamento";
			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function getMunicipios()
		{
			$sql = "SELECT idMunicipio,nombreMunicipio FROM municipio";
			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		// sobrescribiendo metodo pero con parametros para obtener municipios por ajax
		public function getMunicipiosAjax($idDepartamento)
		{
			$sql = "SELECT idMunicipio,nombreMunicipio FROM municipio WHERE idDepartamento=$idDepartamento";
			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}
	}

 ?>