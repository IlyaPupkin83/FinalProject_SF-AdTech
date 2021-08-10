<?php

namespace Post\Webmaster\Stats;

use Core\Database;
use Core\Utils;

class StatsShowModel
{
    public function run()
    {
        $datefrom = !$_POST['datefrom'] ? '2021-01-01' : $_POST['datefrom'];
        $dateto =  !$_POST['dateto'] ? Utils::getCurrentDate() :  $_POST['dateto'];

        if (strtotime($dateto) < strtotime($datefrom)) {
            Utils::message('Конечная дата меньше начальной');
            return false;
        }

        $offer = $_POST['offer'];

        if (!$offer) {
            Utils::message('Не выбран оффер');
            return false;
        }

        $db = new Database;

        $sql = <<<OFFER_STATS
        SELECT Offers.title, Offers.cost, IFNULL(SUM(Redirects.`count`), 0) AS `count`
        FROM Offers
        INNER JOIN Offers_Subs ON (Offers.id = Offers_Subs.offer_id) AND (Offers_Subs.user_id = :userId)
        LEFT JOIN Redirects ON (Offers.id = Redirects.offer_id) AND (Redirects.`date` BETWEEN :datefrom AND :dateto)
        WHERE Offers.id = :offerId
        GROUP BY (Redirects.offer_id)
OFFER_STATS;

        $values = [
            ":datefrom" => $datefrom,
            ":dateto" => $dateto,
            ":offerId" => $offer,
            ":userId" => $_SESSION['userID']
        ];

        $stats = $db->select($sql, $values);

        if ($stats) {
            global $AJAXJSON;

            $AJAXJSON['name'] = $stats->title;
            $AJAXJSON['datefrom'] = $datefrom;
            $AJAXJSON['dateto'] = $dateto;
            $AJAXJSON['redirects'] = $stats->count;
            $AJAXJSON['costs'] = round($stats->count * $stats->cost * (1 - ADTECH_SHARE), 2);

            Utils::message("Статистка обновлена ({$stats->title})");
        }
    }
}
