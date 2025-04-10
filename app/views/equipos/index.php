<!DOCTYPE html>
<html lang="es">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<head>
    <meta charset="UTF-8">
    <title>Listado de Equipos</title>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
		
			$("tr[id^='equipo_']").on("click",function() {
				console.log('cc');
				const idEquipo = this.id.split('_')[1];
				window.location.href = '/gestion_equipos/public/index.php/equipos/'+idEquipo;
			})
		})

	</script>
	<style>
	.title {
		text-align: center
	}
	.container {
		position: relative;
		max-width: 800px;
		margin: auto;
	}
	.add-button {
        float: right;
		margin-bottom: 20px;
		padding: 10px 20px;
		background-color: #28a745;
		color: white;
		border: none;
		border-radius: 5px;
		font-size: 14px;
		cursor: pointer;
        }
	.add-button:hover {
        background-color: #218838;
    }
	table {
		width: 100%;
		border-collapse: collapse;
		margin-top: 20px;
	}
	th {
		background-color: #007bff;
		color: white;
		padding: 12px;
		font-size: 16px;
		font-weight: bold;
		text-align: center;
	}
	td {
		background: #f9f9f9;
		padding: 12px;
		font-size: 15px;
		border: 1px solid #ddd;
		text-align: center;
		vertical-align: middle;
	}
	tbody {
		cursor: pointer;
		
	}
	tr:hover {
		background-color: #f1f1f1;
	}

</style>
</head>
<body>
	<div class="title"><h2>Gestor de Equipos</h2></div>
	<div class="container">
		<a  href="/gestion_equipos/public/index.php/equipos/add" ><button class="add-button" id="add">Añadir</button></a>
		<table>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Deporte</th>
					<th>Ciudad</th>
					<th>Fecha creación</th>
				</tr>
			</thead>
			<tbody>
			<?php if ($equipos) { ?>
				<?php foreach ($equipos as $equipo) { ?>
				<tr class="editable-row" id="equipo_<?php echo $equipo['id']; ?>">
					<td><?php echo $equipo['nombre']; ?></td>
					<td><?php echo $equipo['deporte']; ?></td>
					<td><?php echo $equipo['ciudad']; ?></td>
					<td><?php echo $equipo['fecha_creacion']; ?></td>
				</tr>
				<?php } ?>
			<?php } else { ?>
			   <tr><td colspan='4'>No se encontraron equipos.</td></tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</body>
</html>