<?php
class Router {
    private $routes = [];

    public function addRoute($method, $path, $handler) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		
		$basePath = '/gestion_equipos/public';
		$requestPath = substr($requestPath, strlen($basePath));
		$requestPath = $requestPath === false ? '/' : $requestPath;
		
		$requestPath = rtrim($requestPath, '/');
		if (empty($requestPath)) {
			$requestPath = '/';
		}
		
        foreach ($this->routes as $route) {
			
			$routePath = rtrim($route['path'], '/');
			if (empty($routePath)) {
				$routePath = '/';
			}
	
			
			// Convertir la ruta a patrón regex
			$pattern = '#^' . preg_replace('/:(\w+)/', '(?P<$1>[^/]+)', $routePath) . '$#';
			//var_dump($route['handler']);
            //var_dump($pattern);
			//var_dump($requestPath);
			//var_dump($matches);
			
			
            if ($route['method'] === $requestMethod && preg_match($pattern, $requestPath, $matches)) {
                list($controllerName, $methodName) = explode('@', $route['handler']);
                $controllerClass = ucfirst($controllerName);
                require_once __DIR__ . "/../controllers/$controllerClass.php";
                
                $controller = new $controllerClass();
                $controller->$methodName($matches);
                return;
            }
        }
        
        http_response_code(404);
        echo 'Página no encontrada';
    }
}