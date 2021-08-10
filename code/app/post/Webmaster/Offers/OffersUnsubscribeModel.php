<?php

namespace Post\Webmaster\Offers;

use Core\Database;
use Core\Utils;

class OffersUnsubscribeModel
{
    public function run()
    {
        $offer = $_POST['offer'];

        if (!$offer) {
            Utils::message('Не выбран оффер');
            return false;
        }

        $db = new Database;

        $sql = <<<UNSUBSCRIBE
        DELETE FROM Offers_Subs
        WHERE user_id = :userId AND offer_id = :offerId
UNSUBSCRIBE;
        $values = [
            ':userId' => $_SESSION['userID'],
            ':offerId' => $offer
        ];

        $result = $db->update($sql, $values);

        if ($result) {
            Utils::message('Подписка отключена');
        }
    }
}
