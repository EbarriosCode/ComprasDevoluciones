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

		.titulo{
			margin-top: 0px;
		}

		.izquierda{						
			text-align: left;			
			margin-left: 30px;
			margin-right: 40px;			
		}
		
		.derecha{						
			text-align: right;			
			margin-right: 30px;
			margin-right: 40px;			
		}

		table {
			margin-top: 15px;
		    border-collapse: collapse;
		    width: 100%;
		}

		th{
			background-color: #0B0782;
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
	<!--ENCABEZADO NOTA DE CREDITO DEVOLUCION-->
	<div class="nota-credito-devolucion">
		<h6  class="derecha">NOTA DE CREDITO <br>Serie A12</h6>
		<div class="container">
			<?php foreach($NotaCredito as $datosCredito): ?>
			<?php if(strlen($datosCredito['idNotaCredito']) == 1){ ?>
			<h2 class="titulo">Nota de crédito No. 000<?php echo $datosCredito['idNotaCredito']; ?></h2>
			<?php } ?>

			<?php if(strlen($datosCredito['idNotaCredito']) == 2){ ?>
			<h2 class="titulo">Nota de crédito No. 00<?php echo $datosCredito['idNotaCredito']; ?></h2>
			<?php } ?>

			<?php if(strlen($datosCredito['idNotaCredito']) == 3){ ?>
			<h2 class="titulo">Nota de crédito No. 0<?php echo $datosCredito['idNotaCredito']; ?></h2>
			<?php } ?>

			<?php if(strlen($datosCredito['idNotaCredito']) == 4){ ?>
			<h2 class="tiulo">Nota de crédito No. <?php echo $datosCredito['idNotaCredito']; ?></h2>
			<?php } ?>
	</div>
	<div class="izquierda">
		
			
				<h5>Fecha: <?php echo $datosCredito['fecha']; ?></h5>
				<h5>Cliente: <?php echo $datosCredito['nombreCliente']; ?></h5>
				<h5>Nit: <?php echo $datosCredito['nit']; ?></h5>
				<h5>Direccion: <?php echo $datosCredito['direccion'].", ".$datosCredito['nombreMunicipio'].", ".$datosCredito['nombreDepartamento']; ?></h5> 
			
		<?php endforeach; ?>
		
		<table>
			<tr>
				<th class="th-nota-credito">Codigo</th>
				<th class="th-nota-credito">Descripción</th>
				<th class="th-nota-credito">Cantidad</th>
				<th class="th-nota-credito">Precio Unitario</th>
				<th class="th-nota-credito">Precio Total</th>
			</tr>
			<tr>
				<td><?php echo $datosCredito['codigoProducto']; ?></td>
				<td><?php echo $datosCredito['nombreMarca']." ".$datosCredito['descripcion']; ?></td>
				<td><?php echo $datosCredito['cantidad']; ?></td>
				<td><?php echo $datosCredito['precio']; ?></td>
				<td><?php echo $datosCredito['costoTotal']; ?></td>
			</tr>
		</table>		
		<h6 class="derecha">Sujeto a pagos trimestrales</h6>
		</div>
	
	</div>
</body>
</html>