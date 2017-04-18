<?php 
	require_once('Conexion.php');

	class Devoluciones extends Conexion
	{
		public function DevolverProducto()
		{
			$sql = "";			

			$stmt = Conexion::Conectar()->prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function ExisteFactura($documento)
		{
			$sql = "CALL sp_existeVenta_diferenciaFechas(?,curdate(),@diferencia);";

			$stmt = Conexion::Conectar()->prepare($sql);	
			$valor = $documento;
			$stmt->bindParam(1,$valor,PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT,4000);		
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}
	}

	/*$r = new Devoluciones;
	var_dump($r->ExisteFactura(1)); */
 ?>