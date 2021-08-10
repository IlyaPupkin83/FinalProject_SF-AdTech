<?php

namespace Post\Admin\System;

use Core\Database;
use Core\Utils;

class SystemStatsModel
{
	public function run()
	{
		$datefrom = !$_POST['datefrom'] ? '2021-01-01' : $_POST['datefrom'];
		$dateto =  !$_POST['dateto'] ? Utils::getCurrentDate() :  $_POST['dateto'];

		if (strtotime($dateto) < strtotime($datefrom)) {
			Utils::message('Конечная дата не должна быть меньше начальной!!!');
			return false;
		}

		$db = new Database;

		$values = [
			':from' => $datefrom,
			':to' => $dateto
		];

		$sqlLinks = <<<LINKS_COUNT
        SELECT COUNT(*) AS count
        FROM Offers_Subs
        WHERE date BETWEEN :from AND :to
LINKS_COUNT;

		$linksCount = $db->select($sqlLinks, $values)->count;

		$sqlRedirects = <<<REDIRECTS_COUNT
        SELECT SUM(count) AS count
        FROM Redirects
        WHERE date BETWEEN :from AND :to
REDIRECTS_COUNT;

		$redirectsCount = $db->select($sqlRedirects, $values)->count;

		$sqlRejections = <<<REJECTIONS_COUNT
        SELECT SUM(count) AS count
        FROM Rejections
        WHERE date BETWEEN :from AND :to
REJECTIONS_COUNT;

		$rejectionsCount = $db->select($sqlRejections, $values)->count;

		$sqlFullCosts = <<<FULL_COSTS
        SELECT SUM(Offers.cost * Subtotals.`count`) AS `total`
        FROM Offers
        LEFT JOIN (
            SELECT Redirects.offer_id AS `id`, SUM(Redirects.`count`) AS `count`
            FROM Redirects
            WHERE Redirects.`date` BETWEEN :from AND :to
            GROUP BY Redirects.offer_id
        ) AS `Subtotals`
        USING (`id`)
FULL_COSTS;

		$income = $db->select($sqlFullCosts, $values)->total;

		global $AJAXJSON;

		$AJAXJSON['datefrom'] = $datefrom;
		$AJAXJSON['dateto'] = $dateto;
		$AJAXJSON['links'] = $linksCount;
		$AJAXJSON['redirects'] = $redirectsCount;
		$AJAXJSON['rejections'] = $rejectionsCount;
		$AJAXJSON['income'] = round($income * ADTECH_SHARE, 2);
		Utils::message('Данные обновлены');

		return true;
	}
}
