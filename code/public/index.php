<?php

use Core\Redirector;
use Core\Router as Router;
use Core\Utils as Utils;

define('ROOT', dirname(__DIR__));
require(ROOT . '/app/config/config.php');

if (preg_match('#/redirect.*#', $_SERVER['REQUEST_URI'])) {
	require_once(ROOT . '/app/core/Redirector.php');
	Redirector::start();
	exit();
}

require_once('../vendor/autoload.php');

session_start();

if (!array_key_exists('user', $_SESSION)) {
	$_SESSION['user'] = 'Гость';
	$_SESSION['role'] = 'Guest';
	header("Location: /");
}

$AJAXJSON = [];
$router = new Router;
$router->run();
