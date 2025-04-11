<?php
session_start();

require_once __DIR__ . '/../models/Jugador.php';
require_once __DIR__ . '/../models/Equipo.php';

class JugadorController {
    private $jugadorModel;
    private $equipoModel;

    public function __construct() {
        global $database;
        $this->jugadorModel = new Jugador($database->getConexion());
        $this->equipoModel = new Equipo($database->getConexion());
    }

    public function validations() {
		
		
        $errors = [];
        
        if (empty($_POST['nombre_jugador'])){
            $errors['nombre_jugador'] = 'El nombre es obligatorio';
        }
        
        if (empty($_POST['equipo_id'])) {
            $errors['equipo_id'] = 'El equipo es obligatorio';
        }
		
		$existe_capitan = $this->equipoModel->getCapitan($_POST['equipo_id']);
		if($existe_capitan && isset($_POST['capitan'])){
			 $errors['capitan'] = 'El equipo ya tiene un capitán';
		}
		
        if (count($errors) === 0) {
            $data = [
                'nombre' => $_POST['nombre_jugador'],
                'numero' => $_POST['numero'],
				'capitan' => isset($_POST['capitan']) ? 1 : 0,
                'equipo_id' => $_POST['equipo_id']
            ];
           
            if ($this->jugadorModel->add($data)) {
                header("Location: /gestion_equipos/public/index.php/equipos/{$_POST['equipo_id']}");
                exit;
            }
			
        }
        
		$_SESSION['form_errors'] = $errors;
        header("Location: /gestion_equipos/public/index.php/equipos/{$_POST['equipo_id']}");
        exit;
		
		
    }

    public function edit($params) {
        $jugador = $this->jugadorModel->find($params[1]);
        $equipo = $this->equipoModel->find($jugador['equipo_id']);
        
        require_once __DIR__ . '/../views/jugadores/edit.php';
    }

    public function update($params) {
        $errors = [];
        
        if (empty($_POST['nombre_jugador'])) {
            $errors['nombre_jugador'] = 'El nombre es obligatorio';
        }
		
        $existe_capitan = $this->equipoModel->getCapitan($_POST['equipo_id']);
		if($existe_capitan && isset($_POST['capitan'])){
			 $errors['capitan'] = 'El equipo ya tiene un capitán';
		}
		
        if (count($errors) === 0) {
            $data = [
                'nombre' => $_POST['nombre_jugador'],
                'numero' => $_POST['numero'],
                'capitan' => isset($_POST['capitan']) ? 1 : 0,
				'equipo_id' => $_POST['equipo_id'],

            ];
            if ($this->jugadorModel->update($params[1], $data)) {
                header("Location: /gestion_equipos/public/index.php/equipos/{$_POST['equipo_id']}");
                exit;
            }
        }
        
        $_SESSION['form_errors'] = $errors;
		$jugador = $this->jugadorModel->find($params[1]);
        $equipo = $this->equipoModel->find($jugador['equipo_id']);

        require_once __DIR__ . '/../views/jugadores/edit.php';
		
    }

    public function destroy($params) {
        $jugador = $this->jugadorModel->find($params[1]);
        $this->jugadorModel->delete($jugador['id']);
        
        header("Location: /gestion_equipos/public/index.php/equipos/{$jugador['equipo_id']}");
        exit;
    }
}