<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#------------------------------------------------------------------------------------------
	public function getTemplate(){
		include "views/template.php";
	}

	#INTERACCION DEL USUARIO
	#------------------------------------------------------------------------------------------
	public function getEnlacesPaginasController(){
		if(isset($_GET['action'])){
			$enlacesController = $_GET['action'];
		}else{
			$enlacesController = 'index';
		}
		
		$response = EnlacesPaginas::getEnlacesPaginasModel($enlacesController);
		include($response);
	}

	#REGISTRO DE USUARIOS
	#------------------------------------------------------------------------------------------
	public function registroUsuarioController(){		
		if(isset($_POST['usuarioRegistro'])){
			if( preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuarioRegistro']) && 
				preg_match('/^[a-zA-Z0-9]+$/', $_POST['passwordRegistro']) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['emailRegistro']) ){

				$encriptar = crypt($_POST['passwordRegistro'],'$2a$07$asxx54ahjpgf45sd87a5a4dDDGsystemdev$');

				$datos = array(	'usuario' => $_POST['usuarioRegistro'], 
								'password'=>$encriptar,
								'email'=>$_POST['emailRegistro']);

				$response = new Datos();
				$response->registroUsuarioModel($datos,'usuarios');
				if($response == 'success'){
					header('Location:ok');
				}else{
					header('Location:index.php');
				}
			}
		}
	}

	#INGRESO DE USUARIOS
	#------------------------------------------------------------------------------------------
	public function ingresoUsuarioController(){
		if(isset($_POST['usuarioIngreso'])){
			if( preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuarioIngreso']) && 
				preg_match('/^[a-zA-Z0-9]+$/', $_POST['passwordIngreso'])){

				$encriptar = crypt($_POST['passwordIngreso'],'$2a$07$asxx54ahjpgf45sd87a5a4dDDGsystemdev$');

				$datos = array(	'usuario' => $_POST['usuarioIngreso'], 
								'password'=> $encriptar);

				$response = new Datos();
				$response->ingresoUsuarioModel($datos,'usuarios');
				$intentos = $response['intentos'];
				$maxIntentos = 2;
				if($intentos < $maxIntentos){
					if($response['usuario'] == $_POST['usuarioIngreso'] && $response['password'] == $encriptar){
						session_start();
						$_SESSION['validar'] = true;
						header('Location:usuarios');
					}else{
						header('Location:fallo');
					}
				}
					
			}
		}
	}

	#VISTA DE USUARIO
	#--------------------------------------------------------------------------------------------
	public function vistaUsuarioController(){
		$response = new Datos();
		$response->vistaUsuarioModel('usuarios');
		foreach($response as $row => $item){
			echo '
					<tr>
						<td>'.$item['usuario'].'</td>
						<td>'.$item['password'].'</td>
						<td>'.$item['email'].'</td>
						<td><button>Editar</button></td>
						<td><button>Borrar</button></td>
					</tr>
				';
		}
	}

	#VALIDAR USUARIO EXISTENTE
	#--------------------------------------------------------------------------------------------
	public function validarUsuarioController($validarUsuario){
		$datosController = $validarUsuario;
		$response = new Datos();
		$response->validarUsuarioModel($datosController,'usuarios');
		if(count($response['usuario']) > 0){
			echo 0;
		}else{
			echo 1;
		}
	}

	#VALIDAR EMAIL EXISTENTE
	#--------------------------------------------------------------------------------------------
	public function validarEmailController($validarEmail){
		$datosController = $validarEmail;
		$response = new Datos();
		$response->validarEmailModel($datosController,'usuarios');
		if(count($response['email']) > 0){
			echo 0;
		}else{
			echo 1;
		}
	}
}