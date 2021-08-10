<?php

namespace Get\Webmaster;

use Core\Database;
use Core\Defender;

class SubscriptionsModel
{
	public function run()
	{
		$db = new Database;

		$sql = <<<SUBSCRIPTIONS
        SELECT `id`, `title`, `cost`, `image`
        FROM `Offers`
        INNER JOIN `Offers_Subs` ON (Offers.id = Offers_Subs.offer_id) AND (Offers_Subs.user_id = :userId)
        WHERE active = 1
SUBSCRIPTIONS;

		$values = [
			':userId' => $_SESSION['userID']
		];

		$offers = $db->selectAll($sql, $values);
		$offersList = '';

		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'SubscriptionsView.php';
		$props['viewMenu'] = 'WebmasterMenu.php';
		$props['script'] = 'Webmaster.js';

		if ($offers) {
			foreach ($offers as $offer) {
				$link = $_SERVER['HTTP_HOST'] . "/redirect?wm={$_SESSION['userID']}&of={$offer->id}";
				$imageLink = $offer->image ? htmlspecialchars('<a href="' . $link . '"><img src="' . $_SERVER['HTTP_HOST'] . '/images/'
					. $offer->image . '" alt="' . $offer->title . '"></a>') : 'Изображения отсутствуют';

				$form = <<<OFFER
                <form class="list__offer" action="" method="POST">
                    <input type="hidden" name="offer" id="offerId" value="{$offer->id}">
                    <input type="hidden" name="route" value="webmaster/offers/unsubscribe">
                    <input type="hidden" name="csrf" value="{$props['token']}">
                    <div class="offer__title"><b>{$offer->title} ({$offer->cost})</b></div>
                    <div class="offer__redirect">
                    <div><b>Ссылка:</b></br>$link</div>
                    <div><b>Ссылка-изображение:</b></br>$imageLink</div>
                    </div>
                    <button type="submit" class="offer__subscribe">Отписаться</button>
                </form>
OFFER;
				$offersList .= $form . PHP_EOL;
			}
		}

		$props['offers'] = $offersList;

		return $props;
	}
}
