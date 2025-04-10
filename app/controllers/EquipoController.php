<?php
require_once __DIR__ . '/../models/Equipo.php';

class EquipoController {
    private $equipoModel;

    public function __construct() {
        global $database;
        $this->equipoModel = new Equipo($database->getConexion());
    }

    public function index() {
        $equipos = $this->equipoModel->getAll();
        require_once __DIR__ . '/../views/equipos/index.php';
    }

    public function add() {
		require_once __DIR__ . '/../views/equipos/add.php';
    }

    public function validations() {
        // Validación del servidor
        $errors = [];
        
        if (empty($_POST['nombre'])) {
            $errors['nombre'] = 'El nombre es obligatorio';
        }
        
        
        if (count($errors) === 0) {
            $data = [
                'nombre' => $_POST['nombre'],
                'ciudad' => $_POST['ciudad'],
                'deporte' => $_POST['deporte'],
            ];
            
            if ($this->equipoModel->add($data)) {
                header('Location: /gestion_equipos/public/');
                exit;
            }
        }
        
        // Si hay errores, mostrar el formulario nuevamente
        require_once __DIR__ . '/../views/equipos/add.php';
    }

    public function info($params) {
        $equipo = $this->equipoModel->find($params[1]);
        require_once __DIR__ . '/../views/equipos/info.php';
    }
}