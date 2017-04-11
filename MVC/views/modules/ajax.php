<?php
require_once('../../controllers/controller.php');
require_once('../../models/crud.php');
class Ajax{
	public $validarUsuario;
	public $validarEmail;

	public function validarUsuarioAjax(){
		$datos = $this->validarUsuario;
		$response = new MvcController();
		$response->validarUsuarioController($datos);
		echo $response;
	}

	public function validarEmailAjax(){
		$datos = $this->validarEmail;
		$response = new MvcController();
		$response->validarEmailController($datos);
		echo $response;
	}
}

if(isset($_POST['validarUsuario'])){
	$a = new Ajax();
	$a->validarUsuario = $_POST['validarUsuario'];
	$a->validarUsuarioAjax();
}

if(isset($_POST['validarEmail'])){
	$b = new Ajax();
	$b->validarEmail = $_POST['validarEmail'];
	$b->validarEmailAjax();
}