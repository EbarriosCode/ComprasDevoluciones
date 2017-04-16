<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura No. <?php echo $NoDocumento;?></title>
	<style>
		.nota-credito{
			text-align: right;
			margin-right: 40px;
		}
		.container{
			text-align: center;
		}

		.titul{
			margin-top: 25px;
		}

		.izquierda{						
			text-align: left;			
			margin-left: 30px;
			margin-right: 40px;			
		}

		table {
		    border-collapse: collapse;
		    width: 100%;
		}

		th{
			background-color: #4CAF50;
    		color: white;
		}

		th, td {
		    text-align: left;
		    padding: 8px;
		    border-bottom: 1px solid #ddd;
		}

		tr:nth-child(even){background-color: #f2f2f2}
	</style>

</head>
<body>
	<h6 class="nota-credito">NOTA DE CRÉDITO <br>Serie A12</h6>
	<div class="container">
		<?php if(strlen($NoDocumento) == 1){ ?>
		<h2 class="titulo">Factura Número 000<?php echo $NoDocumento; ?></h2>
		<?php } ?>

		<?php if(strlen($NoDocumento) == 2){ ?>
		<h2 class="titulo">Factura Número 00<?php echo $NoDocumento; ?></h2>
		<?php } ?>

		<?php if(strlen($NoDocumento) == 3){ ?>
		<h2 class="titulo">Factura Número 0<?php echo $NoDocumento; ?></h2>
		<?php } ?>

		<?php if(strlen($NoDocumento) == 4){ ?>
		<h2 class="tiulo">Factura Número <?php echo $NoDocumento; ?></h2>
		<?php } ?>
		<hr>
		
		<div class="izquierda">
		<?php foreach($Factura as $item): ?>
			
				<h5>Fecha: <?php echo $item['fecha']; ?></h5>
				<h5>Cliente: <?php echo $item['nombreCliente']; ?></h5>
				<h5>Nit: <?php echo $item['nit']; ?></h5>
				<h5>Dirección: <?php echo $item['direccion'].", ".$item['nombreMunicipio'].", ".$item['nombreDepartamento']; ?></h5>
			
		<?php endforeach; ?>
		
		<table class="tabla">
			<tr>
				<th>Código</th>
				<th>Descripción</th>
				<th>Cantidad</th>
				<th>Precio Unitario</th>
				<th>Precio Total</th>
			</tr>
			<tr>
				<td><?php echo $item['codigoProducto']; ?></td>
				<td><?php echo $item['nombreMarca']." ".$item['descripcion']; ?></td>
				<td><?php echo $item['cantidad']; ?></td>
				<td><?php echo $item['precio']; ?></td>
				<td><?php echo $item['costoTotal']; ?></td>
			</tr>
		</table>

		</div>
	</div>
</body>
</html>