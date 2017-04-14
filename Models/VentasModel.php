<?php 
	require_once('Conexion.php');

	class Ventas extends Conexion
	{
		public function insertVentas($fecha,$documento,$idCliente,$idProducto,$cantidad)
		{
			$sql = "CALL sp_TransaccionVentasTEST('$fecha','$documento',$idCliente,$idProducto,$cantidad)";
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
			$sql = "SELECT nombreCliente FROM clientes WHERE nit=$nit";
			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function getProductoAjax($codigo)
		{
			$sql = "SELECT nombreProducto FROM productos WHERE codigoProducto='$codigo'";
			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}
	}

	/*$r = new Ventas();
	echo json_encode($r->getVentas(0,5)); */
 ?>