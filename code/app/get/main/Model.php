<?php

namespace Get\Main;

use Core\Model as CoreModel;
use Core\Defender;

class Model extends CoreModel
{
	public function run()
	{
		if ($_SERVER['REQUEST_URI'] != '/') {
			header('Location: /');
			die();
		}

		$role = $_SESSION['role'];

		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'Main' . $role . 'View.php';
		$props['viewMenu'] = $role . 'Menu.php';
		$props['script'] = $role . '.js';

		return $props;
	}
}
