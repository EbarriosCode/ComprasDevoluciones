<!DOCTYPE html>
<html lang="es">
<head>
	<title>Template</title>
	<link rel="stylesheet" type="text/css" href="views/css/estilos.css">
	<script type="text/javascript" src="views/js/jquery-3.1.1.min.js"></script>
</head>
<body>
	<header>
		<h1>LOGOTIPO</h1>
	</header>
	<?php include('modules/navegacion.php'); ?>
	<section>
		<?php
			$mvc = new MvcController();
			$mvc->getEnlacesPaginasController();
		?>
	</section>
	<script type="text/javascript" src="views/js/validarRegistro.js"></script>
</body>
</html>