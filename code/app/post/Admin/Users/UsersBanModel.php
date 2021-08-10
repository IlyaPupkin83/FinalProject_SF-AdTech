<?php

namespace Post\Admin\Users;

use Core\Database;
use Core\Utils;

class UsersBanModel
{
	public function run()
	{
		$login = $_POST['name'];

		if (!$login) {
			Utils::message('Введите имя пользователя');
			return;
		}

		$db = new Database;

		$sql = <<<BAN_USER
        UPDATE Users
        SET status = 0
        WHERE login = :login
BAN_USER;

		$values = [
			":login" => $login
		];

		$result = $db->update($sql, $values);

		if ($result == 0) {
			Utils::message('Пользователя не существует');
		}

		return true;
	}
}
