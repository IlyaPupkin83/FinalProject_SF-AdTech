<?php

namespace Post\Admin\Tematic;

use Core\Database;
use Core\Utils;

class TematicNewModel
{
	public function run()
	{
		$db = new Database;

		$name = ucfirst($_POST['name']);

		if (!$name) {
			Utils::message('Введите наименование тематики');
			return;
		}

		$sql = <<<NEW_TEMATIC
            INSERT IGNORE INTO Tematic(name) VALUES(:name) 
NEW_TEMATIC;

		$values = [
			':name' => $name
		];

		$rows = $db->update($sql, $values);

		if (!$rows) Utils::message("Тематика $name уже существует");

		return true;
	}
}
