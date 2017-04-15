<?php 
	require_once('Conexion.php');

	class Ventas extends Conexion
	{
		public function insertVentas($fecha,$documento,$idCliente,$idProducto,$cantidad)
		{
			$sql = "CALL sp_TransaccionVentas('$fecha','$documento',$idCliente,$idProducto,$cantidad)";
			$stmt = Conexion::Conectar()->prepare($sql);

			if($stmt->execute())
				return true;

			else
				return false;

			$stmt->close();
		}

		public function getVentas($inicio=false,$no_registros=false)
		{ 	
			if($inicio!==false && $no_registros!==false)
			{
				$sql = "SELECT V.idVenta,V.fecha,V.documento,V.idCliente,C.nombreCliente,
				               DV.idProducto,P.nombreProducto,DV.cantidad,DV.precio,DV.costoTotal						       
						FROM ventas V
						INNER JOIN ventasdetalle DV ON V.idVenta = DV.idVenta
						INNER JOIN clientes C ON V.idCliente = C.idCliente
						INNER JOIN productos P ON DV.idProducto = P.idProducto
					    	ORDER BY V.idVenta DESC LIMIT $inicio,$no_registros";
			}
			else{
				$sql = "SELECT V.idVenta,V.fecha,V.documento,V.idCliente,C.nombreCliente,
				               DV.idProducto,P.nombreProducto,DV.cantidad,DV.precio,DV.costoTotal						       
						FROM ventas V
						INNER JOIN ventasdetalle DV ON V.idVenta = DV.idVenta
						INNER JOIN clientes C ON V.idCliente = C.idCliente
						INNER JOIN productos P ON DV.idProducto = P.idProducto
					    	ORDER BY V.idVenta DESC";
			}

			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function numRegistros()
		{
			$sql = "SELECT idVenta FROM ventas";
			$resultado = Conexion::Conectar()->prepare($sql);
			$resultado->execute();
			return $resultado->fetchAll();			 
		}


		public function getClienteAjax($nit)
		{
			$sql = "SELECT idCliente,nombreCliente FROM clientes WHERE nit=$nit";
			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function getProductoAjax($codigo)
		{
			$sql = "SELECT P.idProducto,P.nombreProducto,P.idMarca,P.precio,P.existencia,M.idMarca,M.nombreMarca
				    FROM productos P
					INNER JOIN marcaproductos M ON P.idMarca = M.idMarca
				    WHERE codigoProducto='$codigo'";
			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function getCostoTotalProducto($cantidad)
		{
			$sql = "SELECT idCliente,nombreCliente FROM clientes WHERE nit=$nit";
			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

	}
	
	/*$r = new Ventas();
	var_dump($r->insertVentas('2017-01-01','0010',2,1,2));*/
 ?>