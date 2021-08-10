<?php

namespace Post\Webmaster\Offers;

use Core\Database;
use Core\Utils;

class OffersSubscribeModel
{
    public function run()
    {
        $offer = $_POST['offer'];

        if (!$offer) {
            Utils::message('Не выбран оффер');
            return false;
        }

        $db = new Database;

        $sql = <<<SUB_TO_OFFER
        INSERT IGNORE
        INTO Offers_Subs (`user_id`, `offer_id`, `date`)
        VALUES (:userId, :offerId, :date)
SUB_TO_OFFER;
        $values = [
            ':userId' => $_SESSION['userID'],
            ':offerId' => $offer,
            ':date' => Utils::getCurrentDate()
        ];

        $result = $db->update($sql, $values);

        if ($result) {
            Utils::message('Подписка включена');
        } else {
            Utils::message('Вы уже подписаны');
        }
    }
}
