<?php 
	require_once('Conexion.php');
	class Index extends Conexion
	{
		public function cantidadVentas()
		{
			$sql = "SELECT idVenta FROM ventas";
			$resultado = Conexion::Conectar()->prepare($sql);
			$resultado->execute();
			return $resultado->fetchAll();			 
		}

		public function cantidadDevoluciones()
		{
			$sql = "SELECT idDevolucion FROM devoluciones";
			$resultado = Conexion::Conectar()->prepare($sql);
			$resultado->execute();
			return $resultado->fetchAll();			 
		}

		public function cantidadClientes()
		{
			$sql = "SELECT idCliente FROM clientes";
			$resultado = Conexion::Conectar()->prepare($sql);
			$resultado->execute();
			return $resultado->fetchAll();			 
		}

		public function cantidadProductos()
		{
			$sql = "SELECT idProducto FROM productos";
			$resultado = Conexion::Conectar()->prepare($sql);
			$resultado->execute();
			return $resultado->fetchAll();			 
		}

		public function ClienteConMasCompras()
		{
			$sql = "select @clienteMasCompras :=  C.nombreCliente 
					from ventas S 
					inner join clientes C on C.idCliente=S.idCliente
					group by S.idCliente,C.nombreCliente
            		order by count(1) desc limit 0,1";
			$resultado = Conexion::Conectar()->prepare($sql);
			$resultado->execute();
			return $resultado->fetchAll();			 
		}		
	}

	/*$r = new Index();
	echo count($r->ClienteConMasCompras());*/

 ?>