<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/gestion_equipos/public/assets/css/styles.css">
		<title>Editar Jugador</title>
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			
			<?php if (isset($_SESSION['form_errors'])): ?>
				<?php foreach ($_SESSION['form_errors'] as $error): ?>
					mostrarError('<?php echo addslashes($error); ?>');
				<?php endforeach; ?>
				<?php unset($_SESSION['form_errors']); ?>
			<?php endif; ?>
		});
		
		function mostrarError(message) {
			console.log('aqui');
			const toast = document.createElement('div');
			toast.className = 'toast show';
			toast.style = 'background: #ff4444; color: white; padding: 15px; margin-bottom: 10px; border-radius: 4px;';
			toast.innerHTML = message;
			
			document.getElementById('toastContainer').appendChild(toast);
			
			setTimeout(() => {
				toast.remove();
			}, 3000);
		}
		
		function validateFormJugadores() {
            const nombre_jugador = document.getElementById('nombre_jugador').value;
            const numero = document.getElementById('numero').value;
            
            if (nombre_jugador.trim() === '') {
                alert('El nombre es obligatorio');
                return false;
            }
            
			if (numero.trim() === '') {
                alert('El número es obligatorio');
                return false;
            }
		}
		
        </script>
	</head>
	<body>
		<div id="toastContainer"></div>
		<h1>Editar Jugador</h1>

		<div class="container">
			<a href="/gestion_equipos/public/index.php/equipos/<?php  echo $equipo['id'] ?>"><button>Volver</button></a>

			<form action="/gestion_equipos/public/index.php/jugadores/<?php echo $jugador['id'] ?>" method="post" onsubmit="return validateFormJugadores()">
				<div>
					<label>Nombre:</label>
					<input type="text" id="nombre_jugador" name="nombre_jugador" value="<?php echo $jugador['nombre'] ?>" required>
				</div>
				
				<div>
					<label>Número:</label>
					<input type="numero" id="numero" name="numero" min="1" max="99" value="<?php echo $jugador['numero'] ?>">
				</div>
				<div class="checkbox-container">
				  <label>Capitán</label>
				  <input class="checkbox" type="checkbox" id="capitan" name="capitan" <?= $jugador['capitan'] ? 'checked' : '' ?> >
				</div>
				
				<input type="hidden" name="equipo_id" value="<?php echo $equipo['id']; ?>">
				<button class="submit">Guardar</button>
			</form>
		 </div>
		 
	</body>
</html>