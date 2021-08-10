<?php

namespace Get\Webmaster;

use Core\Database;
use Core\Defender;

class StatsModel
{
	public function run()
	{
		$db = new Database;

		$sql = <<<OFFERS
        SELECT Offers.id AS `id`, Offers.title AS `title`, Users.login AS `advertiser`
        FROM Offers
        INNER JOIN Offers_Subs ON (Offers.id = Offers_Subs.offer_id) AND (Offers_Subs.user_id = :userId)
        INNER JOIN Users ON (Offers.author_id = Users.id)
OFFERS;

		$values = [
			':userId' => $_SESSION['userID']
		];

		$offers = $db->selectAll($sql, $values);

		$offersList = '';

		foreach ($offers as $offer) {
			$element = <<<ELEMENT
            <input type="radio" name="offer" value="{$offer->id}" id="{$offer->id}" required>
            <label for="{$offer->id}">{$offer->advertiser}/{$offer->title}</label>
ELEMENT;
			$offersList .= $element . PHP_EOL;
		}

		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'StatsView.php';
		$props['viewMenu'] = 'WebmasterMenu.php';
		$props['script'] = 'Webmaster.js';
		$props['offers-list'] = $offersList;

		return $props;
	}
}
