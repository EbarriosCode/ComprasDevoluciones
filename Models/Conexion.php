<?php

	class Conexion
	{
		public function Conectar(){
			
			/*$db_servidor = "mysql.hostinger.es";
			$db_usuario  = "u789574939_root";
			$db_password = "rootAnalisis";
			$db_nombre   = "u789574939_sis";  */

			$db_servidor = "localhost";
			$db_usuario  = "root";
			$db_password = "";
			$db_nombre   = "compras-devoluciones";  

			$conexion = new PDO("mysql:	host=$db_servidor;dbname=$db_nombre", $db_usuario, $db_password);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conexion->exec("SET CHARACTER SET utf8");
			return $conexion;
		}
	}

?>

