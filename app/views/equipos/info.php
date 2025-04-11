<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="/gestion_equipos/public/assets/css/styles.css">
    <title><?php echo $equipo['nombre']; ?></title>
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
            
           
            return true;
        }
</script>
</head>
<body>
	<div id="toastContainer"></div>
    <h1><?php echo $equipo['nombre']; ?></h1>
    <div class="container">
		<a href="/gestion_equipos/public/index.php"><button>Volver</button></a>
		<!-- <form action="/gestion_equipos/public/index.php/equipos" method="post" onsubmit="return validateForm()">-->
			
			<div>
				<label >Ciudad:</label>
				<input type="text" id="ciudad" name="ciudad" value="<?php echo $equipo['ciudad']; ?>" disabled>
			</div>
			
			<div>
				<label>Deporte:</label>
				<select id="deporte" name="deporte" disabled>
					<option value="Futbol" <?php echo (strtolower($equipo['deporte']) == 'futbol') ? 'selected' : '' ?> >Fútbol</option>
					<option value="Baloncesto" <?php echo (strtolower($equipo['deporte']) == 'baloncesto') ? 'selected' : '' ?>>Baloncesto</option>
					<option value="Tenis" <?php echo (strtolower($equipo['deporte']) == 'tenis') ? 'selected' : '' ?>>Tenis</option>
					<option value="Otro" <?php echo (strtolower($equipo['deporte']) == 'otro') ? 'selected' : '' ?>>Otro</option>
				</select>
			</div>
		   
			<?php 
				if ($capitan){ ?>
				<div>
					<label >Capitan:</label>
					<input type="text" id="capitan" name="capitan" value="<?php  echo $capitan['nombre']; ?>" disabled>
				</div>
				<?php } ?>
				
			<!--<button class="submit" type="submit">Actualizar</button>-->
		<!--</form>-->
	</div>
	
	<h2>Jugadores</h2>	
	 <div class="container">
		<form action="/gestion_equipos/public/index.php/jugadores" method="post" onsubmit="return validateFormJugadores()">
			<div>
				<label>Nombre:</label>
				<input type="text" id="nombre_jugador" name="nombre_jugador" required>
			</div>
			
			<div>
				<label>Número:</label>
				<input type="numero" id="numero" name="numero" min="1" max="99">
			</div>
			<div class="checkbox-container">
			  <label>Capitán</label>
			  <input class="checkbox" type="checkbox" id="capitan" name="capitan" value="1">
			</div>
			
			<input type="hidden" name="equipo_id" value="<?php echo $equipo['id']; ?>">
			<button class="submit">Añadir Jugador</button>
		</form>
	 </div>
	 
	 
	 <div class="container">
		<table>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Número</th>
					<th>Capitán</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php if ($jugadores) { ?>
				<?php foreach ($jugadores as $jugador) { ?>
				<tr class="editable-row" id="jugador_<?php echo $jugador['id']; ?>">
					<td><?php echo $jugador['nombre']; ?></td>
					<td><?php echo $jugador['numero']; ?></td>
					<td><?php echo ($jugador['capitan'])? "Si": "No"; ?></td>
					<td>
						<a href="/gestion_equipos/public/index.php/jugadores/<?= $jugador['id'] ?>/edit">Editar</a>
						<form action="/gestion_equipos/public/index.php/jugadores/<?= $jugador['id'] ?>/delete" method="post" style="display: inline;">
							<button type="submit">Eliminar</button>
						</form>
						</td>
				</tr>
				<?php } ?>
			<?php } else { ?>
			   <tr><td colspan='4'>No se encontraron jugadores.</td></tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</body>
</html>



<!-- 
<h2>Jugadores</h2>
    
    <form action="/players" method="post">
        <input type="hidden" name="team_id" value="<?= $team['id'] ?>">
        
        <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div>
            <label for="number">Número:</label>
            <input type="number" id="number" name="number" min="1" max="99">
        </div>
        
        <div>
            <label for="position">Posición:</label>
            <select id="position" name="position">
                <option value="portero">Portero</option>
                <option value="defensa">Defensa</option>
                <option value="centrocampista">Centrocampista</option>
                <option value="delantero">Delantero</option>
            </select>
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="is_captain" value="1"> Capitán
            </label>
        </div>
        
        <button type="submit">Añadir Jugador</button>
    </form>
    
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Número</th>
                <th>Posición</th>
                <th>Capitán</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($players as $player): ?>
                <tr>
                    <td><?= htmlspecialchars($player['name']) ?></td>
                    <td><?= $player['number'] ?></td>
                    <td><?= htmlspecialchars($player['position']) ?></td>
                    <td><?= $player['is_captain'] ? 'Sí' : 'No' ?></td>
                    <td>
                        <a href="/players/<?= $player['id'] ?>/edit">Editar</a>
                        <form action="/players/<?= $player['id'] ?>/delete" method="post" style="display: inline;">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <a href="/">Volver al listado</a>
</body>
</html>
-->