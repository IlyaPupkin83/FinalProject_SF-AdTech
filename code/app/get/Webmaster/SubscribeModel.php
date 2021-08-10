<?php

namespace Get\Webmaster;

use Core\Database;
use Core\Defender;

class SubscribeModel
{
	public function run()
	{
		$db = new Database;

		$sqlTematics = <<<TEMATICS
        SELECT id, name
        FROM Tematic
TEMATICS;

		$tematics = $db->selectAll($sqlTematics);

		$tematicId = $_GET['tematic'];

		$tematicList = '';

		if ($tematics) {
			foreach ($tematics as $tematic) {
				$selected = $tematicId == $tematic->id ? ' selected ' : '';
				$option = '<option value="' . $tematic->id . '"' . $selected . '>' . $tematic->name . '</option>';
				$tematicList .= $option . PHP_EOL;
			}
		}


		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'SubscribeView.php';
		$props['viewMenu'] = 'WebmasterMenu.php';
		$props['script'] = 'Webmaster.js';
		$props['tematics'] = $tematicList;

		if (!$tematicId || !is_numeric($tematicId)) return $props;

		$offersList = '';

		$sqlOffers = <<<OFFERS
        SELECT `id`, `title`, `cost`, `image`
        FROM Offers
        INNER JOIN Offers_Tematic ON (Offers.id = Offers_Tematic.offer_id) AND (Offers_Tematic.tematic_id = :tematicId)
        WHERE active = 1
OFFERS;

		$values = [
			':tematicId' => $tematicId
		];

		$offers = $db->selectAll($sqlOffers, $values);

		if ($offers) {
			foreach ($offers as $offer) {
				$image = $offer->image == null ? "" : '<img src="' . '/images/' . $offer->image . '" alt="' . $offer->title . '" draggable="false">';

				$form  = <<<OFFER
                <form class="list__offer" action="" method="POST">
                    <input type="hidden" name="offer" id="offerId" value="{$offer->id}">
                    <input type="hidden" name="route" value="webmaster/offers/subscribe">
                    <input type="hidden" name="csrf" value="{$props['token']}">
                    <div class="offer__title"><b>Наименование: </b>{$offer->title} ({$offer->cost})</div>
                    <div class="offer__image">{$image}</div>
                    <button type="submit" class="offer__subscribe">Подписаться</button>
                </form>
OFFER;
				$offersList .= $form;
			}
		} else {
			$offersList = 'Доступные "офферы" отсутствуют';
		}

		$props['offers'] = $offersList;

		return $props;
	}
}
