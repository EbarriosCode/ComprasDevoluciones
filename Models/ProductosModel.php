<?php 
	class Productos
	{
		public $db, $conn, $productos;

		public function __construct()
		{
			require_once('Conexion.php');
			$this->db = new Conexion();
			$this->conn = $this->db->Conectar();

			$this->productos = array();
		}

		public function conn()
		{
			return $this->conn;
		}

		public function getProductos()
		{
			$sql = "SELECT * FROM productos";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();

			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->productos[] = $row;
			}
			//print_r($this->productos);
			return $this->productos;
		}
	}

	$r = new Productos();
	$arr = $r->getProductos;
	var_dump($arr);

 ?>