<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $equipo['nombre']; ?></title>
	<style>
	.container {
		position: relative;
		max-width: 800px;
		margin: auto;
	}
	.submit {
		background: #4CAF50;
		color: white;
		border: none;
		padding: 10px 15px;
		border-radius: 4px;
		cursor: pointer;
		font-size: 16px;
		width: 100%;
		margin-top:20px
	}
	
	.submit:hover {
		background: #45a049;
	}
	h1 {
		text-align: center;
		color: #333;
	}
	div {
		margin-top:15px
	}
	label {
		display: block;
		margin-bottom: 5px;
		font-weight: bold;
	}
	
	input, select {
		width: 100%;
		padding: 8px;
		border: 1px solid #ddd;
		border-radius: 4px;
		box-sizing: border-box;
	}
	

</style>
</head>
<body>
    <h1><?php echo $equipo['nombre']; ?></h1>
    <div class="container">
		<a href="/gestion_equipos/public/"><button>Volver</button></a>
		<form action="/gestion_equipos/public/index.php/equipos" method="post" onsubmit="return validateForm()">
			
			
			<div>
				<label >Ciudad:</label>
				<input type="text" id="ciudad" name="ciudad" value="<?php echo $equipo['ciudad']; ?>">
			</div>
			
			<div>
				<label>Deporte:</label>
				<select id="deporte" name="deporte">
					<option value="Futbol" <?php echo (strtolower($equipo['deporte']) == 'futbol') ? 'selected' : '' ?> >Fútbol</option>
					<option value="Baloncesto" <?php echo (strtolower($equipo['deporte']) == 'baloncesto') ? 'selected' : '' ?>>Baloncesto</option>
					<option value="Tenis" <?php echo (strtolower($equipo['deporte']) == 'tenis') ? 'selected' : '' ?>>Tenis</option>
					<option value="Otro" <?php echo (strtolower($equipo['deporte']) == 'otro') ? 'selected' : '' ?>>Otro</option>
				</select>
			</div>
		   
			
			<button class="submit" type="submit">Actualizar</button>
		</form>
	</div>
</body>
</html>