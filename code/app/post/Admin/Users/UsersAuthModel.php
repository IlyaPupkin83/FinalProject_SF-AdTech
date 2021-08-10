<?php

namespace Post\Admin\Users;

use Core\Database;
use Core\Utils;

class UsersAuthModel
{
	public function run()
	{
		$usersId = $_POST['noauth'];

		if (!$usersId) {
			Utils::message('Вы ничего не выбрали');
			return;
		}

		$usersId = "'" . implode("', '",  $usersId) . "'";

		$db = new Database;

		$sql = <<<USERS_AUTH
        UPDATE Users
        SET Status = 2
        WHERE 
            id IN ($usersId)
USERS_AUTH;

		$db->update($sql);

		return true;
	}
}
