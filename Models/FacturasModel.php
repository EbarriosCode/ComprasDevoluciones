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
	}

	/*$r = new Facturas();
	echo json_encode($r->getVenta(3));*/

 ?>