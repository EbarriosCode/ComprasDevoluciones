<?php 
	require_once('Conexion.php');

	class Ventas extends Conexion
	{
		public function insertVentas($fecha,$idCliente,$idProducto,$cantidad,$vieneDeDevolucion)
		{
			$sql = "CALL sp_TransaccionVentas('$fecha',$idCliente,$idProducto,$cantidad,'$vieneDeDevolucion');";
			$stmt = Conexion::Conectar()->prepare($sql);

			if($stmt->execute())
				return true;

			else
				return false;

			$stmt->close();
		}

		public function getVentas($desde=false,$hasta=false)
		{ 	
			if($desde!==false && $hasta!==false)
			{
				$sql = "SELECT V.idVenta,V.fecha,V.idCliente,C.nombreCliente,
				               DV.idProducto,P.nombreProducto,DV.cantidad,DV.precio,DV.costoTotal,DV.impresoPagado,DV.vieneDeDevolucion		   
						FROM ventas V
						INNER JOIN ventasdetalle DV ON V.idVenta = DV.idVenta
						INNER JOIN clientes C ON V.idCliente = C.idCliente
						INNER JOIN productos P ON DV.idProducto = P.idProducto
							WHERE V.fecha >='$desde' AND V.fecha <='$hasta'
					    	ORDER BY V.idVenta DESC";
			}
			else{
				$sql = "SELECT V.idVenta,V.fecha,V.idCliente,C.nombreCliente,
				               DV.idProducto,P.nombreProducto,DV.cantidad,DV.precio,DV.costoTotal,DV.impresoPagado,DV.vieneDeDevolucion		   						       
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

		public function getUltimaVenta()
		{
			$sql = "SELECT max(idVenta) FROM ventas";
			$resultado = Conexion::Conectar()->prepare($sql);
			$resultado->execute();
			return $resultado->fetchAll();			 
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
			$sql = "SELECT P.idProducto,P.codigoProducto,P.nombreProducto,P.idMarca,P.precio,P.existencia,M.idMarca,M.nombreMarca
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

		public function setImpresoPagado($idVenta)
		{
			$sql = "UPDATE ventasdetalle SET impresoPagado=1 WHERE idVenta=$idVenta";
			$stmt = Conexion::Conectar()->prepare($sql);
			
			if($stmt->execute())
				return true;

			else
				return false;
			
			$stmt->close();
		}

	}
	
	/*$r = new Ventas();
	var_dump($r->getUltimaVenta());*/
 ?>