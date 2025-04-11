<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="/gestion_equipos/public/assets/css/styles.css">
    <title>Añadir Equipo</title>
    <script>
	
        function validateForm() {
            const nombre = document.getElementById('nombre').value;
            const ciudad = document.getElementById('ciudad').value;
            
            if (nombre.trim() === '') {
                alert('El nombre es obligatorio');
                return false;
            }
            
			if (ciudad.trim() === '') {
                alert('La ciudad es obligatoria');
                return false;
            }
            
           
            return true;
        }
    </script>
</head>
<body>
    <h1>Crear Nuevo Equipo</h1>
    <div class="container">
		<a href="/gestion_equipos/public/index.php"><button>Volver</button></a>
		<form action="/gestion_equipos/public/index.php/equipos" method="post" onsubmit="return validateForm()">
			<div>
				<label>Nombre:</label>
				<input type="text" id="nombre" name="nombre" required>
				<?php if (isset($errors['nombre'])){ ?>
					<span style="color: red;"><?= $errors['nombre'] ?></span>
				<?php } ?>
			</div>
			
			<div>
				<label >Ciudad:</label>
				<input type="text" id="ciudad" name="ciudad">
			</div>
			
			<div>
				<label>Deporte:</label>
				<select id="deporte" name="deporte">
					<option value="Futbol">Fútbol</option>
					<option value="Baloncesto">Baloncesto</option>
					<option value="Tenis">Tenis</option>
					<option value="Otro">Otro</option>
				</select>
			</div>
		   
			
			<button class="submit" type="submit">Guardar</button>
		</form>
	</div>
</body>
</html>


