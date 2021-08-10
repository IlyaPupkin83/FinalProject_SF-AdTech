<?php

namespace Core;

class Redirector
{
	public static function start()
	{
		$wm = $_GET['wm'];
		$of = $_GET['of'];

		if (!is_numeric($wm) || !is_numeric($of) || $wm <= 0 || $of <= 0) {
			include_once(TEMPLATES . 'page404.php');
			return;
		}

		require_once(ROOT . '/app/core/Database.php');

		$db = new Database;

		function getLink(Database &$db, &$wm, &$of)
		{
			$sql = <<<IS_SUB
            SELECT link FROM
            Offers
            INNER JOIN Offers_Subs ON (Offers.id = Offers_Subs.offer_id) AND (Offers_Subs.offer_id = :offerId) AND (Offers_Subs.user_id = :userId)
            WHERE active = 1
    IS_SUB;

			$values = [
				':userId' => $wm,
				':offerId' => $of
			];

			$link = $db->select($sql, $values);
			if ($link) return $link->link;

			return false;
		}

		$link = getLink($db, $wm, $of);

		function writeCase(Database &$db, &$of, bool $success = true)
		{
			$table = $success ? 'Redirects' : 'Rejections';

			$sql = <<<WRITE_CASE
            INSERT INTO $table (`date`, `offer_id`)
            VALUES (:date, :offerId)
            ON DUPLICATE KEY UPDATE `count` = `count`+1
    WRITE_CASE;
			$values = [
				':date' => date('Y-m-d', time()),
				':offerId' => $of
			];

			$db->update($sql, $values);
		}

		if ($link) {
			writeCase($db, $of);
			header("Location: $link");
		} else {
			writeCase($db, $of, false);
			include_once(TEMPLATES . 'page404.php');
		}
	}
}
