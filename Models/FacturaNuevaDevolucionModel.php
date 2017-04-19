<?php 
	require_once('Conexion.php');

	class Facturas extends Conexion
	{
		public function getVenta($idVenta)
		{ 				
			$sql = "SELECT V.idVenta,V.fecha,V.idCliente,C.nombreCliente,C.nit,C.direccion,M.nombreMunicipio,					
					       D.nombreDepartamento,DV.idProducto,P.nombreProducto,P.codigoProducto,P.descripcion,
					       MP.nombreMarca,DV.cantidad,DV.precio,DV.costoTotal				
					FROM ventas V
					INNER JOIN ventasdetalle DV ON V.idVenta = DV.idVenta
					INNER JOIN clientes C ON V.idCliente = C.idCliente
					INNER JOIN productos P ON DV.idProducto = P.idProducto
					INNER JOIN marcaproductos MP ON P.idMarca = MP.idMarca
					INNER JOIN municipio M ON C.idMunicipio = M.idMunicipio
					INNER JOIN departamento D ON M.idDepartamento = D.idDepartamento
					WHERE V.idVenta = $idVenta";
			

			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function getNotaCredito($documentoCausoNotaCredito)
		{ 				
			$sql = "SELECT N.idNotaCredito,N.fechaNotaCredito,V.idVenta,V.fecha,V.idCliente,C.nit,C.direccion,
						   M.nombreMunicipio,D.nombreDepartamento,VD.idProducto,P.nombreProducto,P.codigoProducto,
						   P.descripcion,MP.nombreMarca,
						   VD.cantidad,VD.precio,VD.costoTotal,C.nombreCliente
					FROM notasdecredito N
					INNER JOIN ventas V ON N.idVenta = V.idVenta
					INNER JOIN ventasdetalle VD ON V.idVenta = VD.idVenta
					INNER JOIN clientes C ON V.idCliente = C.idCliente
					INNER JOIN productos P ON VD.idProducto = P.idProducto
					INNER JOIN marcaproductos MP ON P.idMarca = MP.idMarca
					INNER JOIN municipio M ON C.idMunicipio = M.idMunicipio
					INNER JOIN departamento D ON M.idDepartamento = D.idDepartamento
					WHERE N.idVentaGeneroEsta = $documentoCausoNotaCredito";
			

			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

	}

	/*$r = new Facturas();
	echo json_encode($r->getNotaCredito(31));*/

 ?>