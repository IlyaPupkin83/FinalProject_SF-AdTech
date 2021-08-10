<?php

namespace Core;

use Core\Defender as Defender;

class Router
{
	public function __construct()
	{
		require_once(ROOT . '/app/config/routes.php');
	}

	private static $getRoutes = [];
	private static $postRoutes = [];

	//Create get-route
	public static function get(string $uri, array $roles, string $controller, string $action = "")
	{
		$route = ['controller' => $controller, 'action' => $action, 'roles' => $roles];
		static::$getRoutes[$uri] = $route;
	}

	//Create post-route
	public static function post(string $route, array $roles, string $controller, string $action)
	{
		$arr = ['controller' => $controller, 'action' => $action, 'roles' => $roles];
		static::$postRoutes[$route] = $arr;
	}

	public function run()
	{
		if (array_key_exists('route', $_POST)) {
			$this->runPost($_POST['route']);
			if (Utils::isAjax()) return;
		}
		$this->runGet($_SERVER['REQUEST_URI']);
	}

	private function runPost($route)
	{
		$result = $this->findRoute(static::$postRoutes, $route);

		if ($result) {
			Defender::validateToken();
			Defender::defensePost();
			$this->callController($result, 'POST');
		}
	}

	private function runGet($uri)
	{
		$options = $this->findRoute(static::$getRoutes, $uri);

		if ($options) {
			$this->callController($options);
		} else {
			require_once(TEMPLATES . 'page404.php');
			exit();
		}
	}

	private function findRoute($routes, $requiredPattern)
	{
		foreach (array_keys($routes) as $route) {
			if (preg_match("~$route~i", $requiredPattern)) {
				$options = $routes[$route];

				if (in_array($_SESSION['role'], $options['roles'])) {
					return $options;
				}
			}
		}

		return false;
	}

	private function callController($options, $type = "GET")
	{
		$path = ($type === 'POST') ? POST : GET;
		$path .= $options['controller'] . '/';
		$controllerFile = $path . 'Controller.php';

		if (file_exists($controllerFile)) {
			require_once($controllerFile);

			try {
				$sns = ($type === 'POST') ? 'Post' : 'Get';
				$class = $sns . '\\' . str_replace('/', '\\', $options['controller']) . '\\Controller';
				$controller = new $class;
				$controller->run($options['action']);
			} catch (\Exception $e) {
				exit();
			}
		} else {
			exit("File of controller $controllerFile is not exists");
		}
	}
}
