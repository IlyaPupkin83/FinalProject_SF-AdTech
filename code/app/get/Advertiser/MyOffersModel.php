<?php

namespace Get\Advertiser;

use Core\Database;
use Core\Defender;

class MyOffersModel
{
	public function run()
	{

		$db = new Database;

		$sqlList = <<<ADV_OFFERS
        SELECT Offers.id as Id, Offers.title AS 'Title' , Offers.link AS 'Link', Offers.cost AS Cost, Offers.image AS Image , COUNT(Offers_Subs.user_id) AS 'Subs'
        FROM Offers
        LEFT JOIN Offers_Subs ON Offers.id = Offers_Subs.offer_id
        WHERE Offers.author_id = :userId AND active = 1
        GROUP BY Offers.id
ADV_OFFERS;

		$values = [
			":userId" => $_SESSION['userID']
		];

		$offers = $db->selectAll($sqlList, $values);

		$offerslist = '';

		foreach ($offers as $offer) {
			$image = $offer->Image == null ? "" : '<img src="' . '/images/' . $offer->Image . '" alt="' . $offer->Title . '" draggable="false">';

			$div = <<<OFFER
            <div class="list__offer" draggable="true">
                <input type="hidden" name="offerId" id="offerId" value="{$offer->Id}">
                <div class="offer__title"><b>Название: </b>{$offer->Title}</div>
                <div class="offer__link"><b>Ссылка: </b>{$offer->Link}</div>
                <div class="offer__cost"><b>Стоимость: </b>{$offer->Cost}</div>
                <div class="offer__subs"><b>Подписалось: </b>{$offer->Subs}</div>
                <div class="offer__image">{$image}</div>
            </div>
OFFER;
			$offerslist .= $div . PHP_EOL;
		}

		$sqlDisable = <<<ADV_DISABLE
        SELECT Offers.id as Id, Offers.title AS 'Title' , Offers.link AS 'Link', Offers.cost AS Cost, Offers.image AS Image , COUNT(Offers_Subs.user_id) AS 'Subs'
        FROM Offers
        LEFT JOIN Offers_Subs ON Offers.id = Offers_Subs.offer_id
        WHERE Offers.author_id = :userId AND active = 0
        GROUP BY Offers.id
ADV_DISABLE;

		$disableOffers = $db->selectAll($sqlDisable, $values);

		$disableList = '';

		foreach ($disableOffers as $offer) {
			$image = $offer->Image == null ? "" : '<img src="' . 'images/' . $offer->Image . '" alt="' . $offer->Title . '" draggable="false">';

			$div = <<<DISABLE_OFFER
            <div class="list__offer list__offer_disable" draggable="true">
                <input type="hidden" name="offerId" id="offerId" value="{$offer->Id}">
                <div class="offer__title"><b>Название: </b>{$offer->Title}</div>
                <div class="offer__link"><b>Ссылка: </b>{$offer->Link}</div>
                <div class="offer__cost"><b>Стоимость: </b>{$offer->Cost}</div>
                <div class="offer__subs"><b>Подписалось: </b>{$offer->Subs}</div>
                <div class="offer__image">{$image}</div>
            </div>
DISABLE_OFFER;
			$disableList .= $div . PHP_EOL;
		}

		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'MyOffersView.php';
		$props['viewMenu'] = 'AdvertiserMenu.php';
		$props['script'] = 'Advertiser.js';
		$props['offers-list'] = $offerslist;
		$props['disable-list'] = $disableList;

		return $props;
	}
}
