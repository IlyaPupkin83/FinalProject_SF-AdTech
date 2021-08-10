<?php

namespace Get\Advertiser;

use Core\Database;
use Core\Defender;

class NewOfferModel
{
	public function run()
	{
		$db = new Database;

		$sql = <<<TEMATICS
        SELECT id, name
        FROM Tematic
TEMATICS;

		$tematics = $db->selectAll($sql);

		$optionsList = '';

		foreach ($tematics as $tematic) {
			$option = '<option value="' . $tematic->id . '">' . $tematic->name . '</option>';
			$optionsList .= $option . PHP_EOL;
		}

		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'NewOfferView.php';
		$props['viewMenu'] = 'AdvertiserMenu.php';
		$props['script'] = 'Advertiser.js';
		$props['tematicsList'] = $optionsList;

		return $props;
	}
}
