<?php

namespace Post\Sign;

use Core\Utils;

class SignOutModel
{
	public function run()
	{
		$user = $_SESSION['user'];
		$_SESSION['user'] = 'Гость';
		$_SESSION['role'] = 'Guest';
		$_SESSION['userID'] = null;
		Utils::message("До встречи, $user!");
	}
}
