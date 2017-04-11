<?php

class EnlacesPaginas{
	public function getEnlacesPaginasModel($enlacesModel){
		if($enlacesModel=='ingresar'|| $enlacesModel=='usuarios' || $enlacesModel=='salir'){
			$module = 'views/modules/'.$enlacesModel.'.php';
		}else if($enlacesModel == 'index'){
			$module = 'views/modules/registro.php';
		}elseif($enlacesModel == 'ok'){
			$module = 'views/modules/registro.php';
		}elseif($enlacesModel == 'fallo'){
			$module = 'views/modules/ingresar.php';
		}else{
			$module = 'views/modules/registro.php';
		}
		return $module;
	}
}