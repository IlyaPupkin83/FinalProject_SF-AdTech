<!-- 
Для проверки приложения, имитация работы с БД
-->

<?php
$scriptStart = time();

define('ROOT', dirname(__DIR__));
require(ROOT . '/app/config/config.php');
require_once(ROOT . '/app/core/Database.php');

$offers = [7, 8, 9, 9, 8];
$users = [18];
$timefrom = 1609459200;
$timeto = 1626480000;
$rowscount = 200;

function getLink(Core\Database &$db, &$wm, &$of)
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

function writeCase(Core\Database &$db, &$of, bool $success = true)
{
	$table = $success ? 'Redirects' : 'Rejections';

	$sql = <<<WRITE_CASE
            INSERT INTO $table (`date`, `offer_id`)
            VALUES (:date, :offerId)
            ON DUPLICATE KEY UPDATE `count` = `count`+1
    WRITE_CASE;

	global $timefrom;
	global $timeto;

	$values = [
		':date' => date('Y-m-d', mt_rand($timefrom, $timeto)),
		':offerId' => $of
	];

	$db->update($sql, $values);
}

for ($i = 0; $i < $rowscount; $i++) {
	$db = new Core\Database;
	$of = $offers[array_rand($offers)];
	$wm = $users[array_rand($users)];

	$link = getLink($db, $wm, $of);

	if ($link) {
		writeCase($db, $of);
	} else {
		writeCase($db, $of, false);
	}
}

$scriptEnd = time() - $scriptStart . ' sec';

echo $scriptEnd;
