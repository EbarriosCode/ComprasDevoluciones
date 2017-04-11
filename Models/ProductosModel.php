<?php 

	class Productos
	{
		//public $db, $conn, $productos;

		/*public function __construct()
		{
			require_once('Conexion.php');
			$this->db = new Conexion();
			$this->conn = $this->db->Conectar();

			$this->productos = array();
		}*/

		public function conn()
		{
			return $this->productos;
		}

		public function getProductos()
		{ 
			require_once('Conexion.php');
			$db = new Conexion();
			$conn = $db->Conectar();
			
			$sql = "SELECT * FROM productos";
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$productos = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$productos[] = $row;
			}
			//print_r($this->productos);
			return $productos;
		}
	}

	$r = new Productos();
	var_dump($r->getProductos);


 ?>