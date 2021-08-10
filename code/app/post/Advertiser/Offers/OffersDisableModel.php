<?php

namespace Post\Advertiser\Offers;

use Core\Database;
use Core\Utils;

class OffersDisableModel
{
	public function run()
	{
		$id = $_POST['id'];

		if (!$id) {
			Utils::message('Ошибка');
			return false;
		}

		$db = new Database;

		$sql = <<<OFFER_ENABLE
        UPDATE Offers
        SET `active` = 0
        WHERE id = :id AND author_id = :authorId
OFFER_ENABLE;

		$values = [
			":id" => $id,
			":authorId" => $_SESSION['userID']
		];

		$result = $db->update($sql, $values);

		if ($result) {
			Utils::message('"Оффер" деактивирован');
		}
	}
}
