<?php

	class Conexion
	{
		public function Conectar(){
			
			/*$db_servidor = "mysql.hostinger.es";
			$db_usuario  = "u892132586_admin";
			$db_password = "2890145354";
			$db_nombre   = "u892132586_app";  */

			$db_servidor = "localhost";
			$db_usuario  = "root";
			$db_password = "";
			$db_nombre   = "compras-devoluciones";

			$conexion = new PDO("mysql:charset=utf8;host=$db_servidor;dbname=$db_nombre", $db_usuario, $db_password);
			return $conexion;
		}
	}

 /*$r = new Conexion();
 var_dump($r->Conectar()); */
?>

