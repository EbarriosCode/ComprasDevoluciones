<?php
class Conexion{
	public function conectar(){
		$link = new PDO('mysql:host=localhost;dbname=compras-devoluciones','root','');
		return $link;
	}
}