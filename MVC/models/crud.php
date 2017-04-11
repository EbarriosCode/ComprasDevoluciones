<?php
require_once('conexion.php');
class Datos extends Conexion{
	#REGISTRO DE USUARIOS
	#-------------------------------------------------------------------
	public function registroUsuarioModel($datos,$tabla){
		$sql = "INSERT INTO $tabla(usuario,password,email) VALUES(:usuario,:password,:email)";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(':usuario',$datos['usuario'], PDO::PARAM_STR);
		$stmt->bindParam(':password',$datos['password'], PDO::PARAM_STR);
		$stmt->bindParam(':email',$datos['email'], PDO::PARAM_STR);

		if($stmt->execute()){
			return 'success';
		}else{
			return 'error';
		}
		$stmt->close();
	}

	#INGRESO DE USUARIO
	#-------------------------------------------------------------------
	public function ingresoUsuarioModel($datos,$tabla){
		$sql = "SELECT usuario,password,intentos FROM $tabla WHERE usuario=:usuario";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':usuario', $datos['usuario'], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	#VISTA DE USUARIO
	#--------------------------------------------------------------------------
	public function vistaUsuarioModel($tabla){
		$sql = "SELECT id,usuario,password,email FROM usuarios";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#VALIDAR USUARIO EXISTENTE
	#--------------------------------------------------------------------------------------------
	public function validarUsuarioModel($datosModel,$tabla){
		$sql = "SELECT usuario FROM $tabla WHERE usuario=:usuario";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':usuario',$datosModel, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	#VALIDAR EMAIL EXISTENTE
	#--------------------------------------------------------------------------------------------
	public function validarEmailModel($datosModel,$tabla){
		$sql = "SELECT email FROM $tabla WHERE email=:email";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':email',$datosModel, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
}