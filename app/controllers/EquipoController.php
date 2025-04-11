<?php
require_once __DIR__ . '/../models/Equipo.php';
require_once __DIR__ . '/../models/Jugador.php'; 


class EquipoController {
    private $equipoModel;
	private $jugadorModel;

    public function __construct() {
        global $database;
        $this->equipoModel = new Equipo($database->getConexion());
        $this->jugadorModel = new Jugador ($database->getConexion());
    }

    public function index() {
        $equipos = $this->equipoModel->getAll();
        require_once __DIR__ . '/../views/equipos/index.php';
    }

    public function add() {
		require_once __DIR__ . '/../views/equipos/add.php';
    }

    public function validations() {
        
		$data = [
			'nombre' => $_POST['nombre'],
			'ciudad' => $_POST['ciudad'],
			'deporte' => $_POST['deporte'],
		];
            
		if ($this->equipoModel->add($data)) {
			header('Location: /gestion_equipos/public/index.php');
			exit;
		}
    }

    public function info($params) {
        $equipo = $this->equipoModel->find($params[1]);
		$capitan = $this->equipoModel->getCapitan($params[1]);
		$jugadores = $this->jugadorModel->getByEquipo($params[1]);
		
        require_once __DIR__ . '/../views/equipos/info.php';
    }
	

}