<?php

namespace Get\Admin;

use Core\Database;
use Core\Defender;

class UsersModel
{
	public function run()
	{
		$db = new Database;

		$sql = <<<WAIT_AUTH_LIST
        SELECT id, login, role, status
        FROM Users
        WHERE status IN (0, 1)
        ORDER BY status DESC
WAIT_AUTH_LIST;

		$waitAuth = $db->selectAll($sql);
		$optionList = '';

		foreach ($waitAuth as $user) {
			$optionList .= '<option value="' . $user->id . '">' . $user->login . ' (' . $user->role . ')';
			$optionList .= ($user->status == '0') ? ' [banned]' . '</option>' . PHP_EOL : '</option>' . PHP_EOL;
		}

		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'UsersView.php';
		$props['viewMenu'] = 'AdminMenu.php';
		$props['script'] = 'admin.js';
		$props['noAuthList'] = $optionList;

		return $props;
	}
}
