<?php

namespace Get\Advertiser;

use Core\Database;
use Core\Defender;

class StatsModel
{
	public function run()
	{
		$db = new Database;

		$sql = <<<OFFERS_LIST
        SELECT id, title
        FROM Offers
        WHERE author_id = :userid
OFFERS_LIST;

		$values = [
			':userid' => $_SESSION['userID']
		];

		$offers = $db->selectAll($sql, $values);

		$offersList = '';

		foreach ($offers as $offer) {
			$element = <<<ELEMENT
            <input type="radio" name="offer" value="{$offer->id}" id="{$offer->id}" required>
            <label for="{$offer->id}">{$offer->title}</label>
ELEMENT;
			$offersList .= $element . PHP_EOL;
		}

		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'StatsView.php';
		$props['viewMenu'] = 'AdvertiserMenu.php';
		$props['script'] = 'Advertiser.js';
		$props['offers-list'] = $offersList;

		return $props;
	}
}
