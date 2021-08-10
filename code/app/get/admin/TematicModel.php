<?php

namespace Get\Admin;

use Core\Database;
use Core\Defender;

class TematicModel
{
	public function run()
	{
		$db = new Database;

		$sql = <<<TEMATIC_LIST
        SELECT Tematic.id AS id, Tematic.name AS name, COUNT(Offers_Tematic.offer_id) AS offersCount
        FROM Tematic
        LEFT JOIN Offers_Tematic
        ON Tematic.id = Offers_Tematic.tematic_id
        GROUP BY Tematic.id
TEMATIC_LIST;

		$tematics = $db->selectAll($sql);
		$optionList = '';

		foreach ($tematics as $tematic) {
			$optionList .= '<option value="' . $tematic->id . '">' . $tematic->name . ': ' . $tematic->offersCount . '</option>' . PHP_EOL;
		}

		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'TematicView.php';
		$props['viewMenu'] = 'AdminMenu.php';
		$props['script'] = 'admin.js';
		$props['tematics'] = $optionList;
		return $props;
	}
}
