<?php 
	require_once('Conexion.php');

	class Devoluciones extends Conexion
	{
		public function DevolverProducto($documento,$idProducto,$cantidadProducto,$idCliente)
		{
			$sql = "CALL sp_TransaccionDevoluciones(curdate(),$documento,$idProducto,$cantidadProducto,$idCliente)";			

			$stmt = Conexion::Conectar()->prepare($sql);

			if($stmt->execute())
				return true;

			else
				return false;

			$stmt->close();
		}

		public function ExisteFactura($documento)
		{
			$sql = "CALL sp_existeVenta_diferenciaFechas(?,curdate(),@diferencia);";

			$stmt = Conexion::Conectar()->prepare($sql);				
			$stmt->bindParam(1,$documento,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);		
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function getFechaDevolucion($documento)
		{
			$sql = "SELECT fechaDevolucion FROM devoluciones WHERE idVenta = $documento";

			$stmt = Conexion::Conectar()->prepare($sql);						
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function getDevoluciones($desde=false,$hasta=false)
		{ 	
			if($desde!==false && $hasta!==false)
			{
				$sql = "SELECT D.idDevolucion,D.fechaDevolucion,D.idVenta,C.nombreCliente,
				               DD.idProducto,P.nombreProducto,DD.cantidad,DD.precio,DD.costoTotal,DD.impreso		   
						FROM devoluciones D
						INNER JOIN devolucionesdetalle DD ON D.idDevolucion = DD.idDevolucion
						INNER JOIN clientes C ON DD.idCliente = C.idCliente
						INNER JOIN productos P ON DD.idProducto = P.idProducto
							WHERE D.fechaDevolucion >='$desde' AND D.fechaDevolucion <='$hasta'
					    	ORDER BY D.idDevolucion DESC";
			}
			else{
				$sql = "SELECT D.idDevolucion,D.fechaDevolucion,D.idVenta,C.nombreCliente,
				               DD.idProducto,P.nombreProducto,DD.cantidad,DD.precio,DD.costoTotal,DD.impreso		   
						FROM devoluciones D
						INNER JOIN devolucionesdetalle DD ON D.idDevolucion = DD.idDevolucion
						INNER JOIN clientes C ON DD.idCliente = C.idCliente
						INNER JOIN productos P ON DD.idProducto = P.idProducto							
					    	ORDER BY D.idDevolucion DESC";
			}

			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function numRegistros()
		{
			$sql = "SELECT idDevolucion FROM devoluciones";
			$resultado = Conexion::Conectar()->prepare($sql);
			$resultado->execute();
			return $resultado->fetchAll();			 
		}

	}

	/*$r = new Devoluciones;
	var_dump($r->getDevoluciones('2017-04-18','2017-04-18')); */
 ?>