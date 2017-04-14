<?php 
	require_once('Conexion.php');

	class Productos extends Conexion
	{
	
		public function getProductos($inicio=false,$no_registros=false)
		{ 	
			if($inicio!==false && $no_registros!==false)
			{
				$sql = "SELECT P.idProducto,P.codigoProducto,P.nombreProducto,P.descripcion,P.precio,P.costo,P.existencia,P.idMarca,M.nombreMarca
					    FROM productos P
					    INNER JOIN marcaproductos M ON P.idMarca = M.idMarca
					    	ORDER BY P.idProducto DESC LIMIT $inicio,$no_registros";
			}
			else{
				$sql = "SELECT P.idProducto,P.codigoProducto,P.nombreProducto,P.descripcion,P.precio,P.costo,P.existencia,P.idMarca,M.nombreMarca
					    FROM productos P
					    INNER JOIN marcaproductos M ON P.idMarca = M.idMarca
					    	ORDER BY P.idProducto DESC";	
			}

			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function numRegistros()
		{
			$sql = "SELECT idProducto FROM productos";
			$resultado = Conexion::Conectar()->prepare($sql);
			$resultado->execute();
			return $resultado->fetchAll();			 
		}

		public function insertProductos($codigoProducto,$producto,$descripcion,$precio,$costo,$existencia,$idMarca)
		{
			$sql = "INSERT INTO productos(codigoProducto,nombreProducto,descripcion,precio,costo,existencia,idMarca) VALUES(?,?,?,?,?,?,?)";
			$stmt = Conexion::Conectar()->prepare($sql);

			if($stmt->execute(array($codigoProducto,$producto,$descripcion,$precio,$costo,$existencia,$idMarca)))
				return true;

			else
				return false;

			$stmt->close();
		}

		public function updateProductos($idProducto,$codigoProducto,$nombreProducto,$descripcion,$precio,$costo,$existencia,$idMarca)
		{
			$sql = "UPDATE productos SET codigoProducto='$codigoProducto',nombreProducto='$nombreProducto',descripcion='$descripcion',precio=$precio,costo=$costo,existencia=$existencia,idMarca=$idMarca WHERE idProducto=$idProducto";
			$stmt = Conexion::Conectar()->prepare($sql);

			if($stmt->execute())
				return true;

			else
				return false;

			$stmt->close();	
		}

		public function deleteProductos($idProducto)
		{
			$sql = "DELETE FROM Productos WHERE idProducto=$idProducto";
			$stmt = Conexion::Conectar()->prepare($sql);

			if($stmt->execute())
				return true;

			else
				return false;

			$stmt->close();		
		}

		public function getMarcas()
		{
			$sql = "SELECT idMarca,nombreMarca FROM marcaproductos";
			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}
	}

	/*$r = new Productos();
	echo sizeof($r->numRegistros());*/
 ?>