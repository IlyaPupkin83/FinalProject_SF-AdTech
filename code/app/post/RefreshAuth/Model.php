<?php

namespace Post\RefreshAuth;

use Core\Database;
use Core\Utils;

class Model
{
	public function run()
	{
		$db = new Database;
		$sql = <<<IS_VERIFY
        SELECT status
        FROM Users
        WHERE login = :login
IS_VERIFY;

		$values = [
			':login' => $_SESSION['user']
		];

		$_SESSION['userStatus'] = $db->select($sql, $values)->status;

		Utils::message('Статус обновлен');
	}
}
