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
	}

	/*$r = new Devoluciones;
	var_dump($r->ExisteFactura(1)); */
 ?>