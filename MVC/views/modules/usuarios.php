<?php
session_start();
if(!$_SESSION['validar']){
	header('Location:ingresar');
	exit();
}
?>
<h1>USUARIOS</h1>

<table border="1">
	<thead>
		<tr>
			<th>Usuario</th>
			<th>Contraseña</th>
			<th>Email</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
			$vistaUsuarios = new MvcController();
			$vistaUsuarios->vistaUsuarioController();
		?>
	</tbody>
</table>
