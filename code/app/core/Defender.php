<?php

namespace Core;

class Defender
{
	private static function shieldString(string &$string)
	{
		$string = trim(strip_tags($string));
		$string =  preg_replace("/\s{2,}/", " ", $string);
	}

	// Убирает теги HTML, PHP и лишние пробелы из $ _GET
	public static function defenseGet()
	{
		foreach ($_GET as $key => $value) {
			if (is_array($_GET[$key])) {
				array_walk_recursive($_GET[$key], "Core\Defender::shieldString");
			} else {
				static::shieldString($_GET[$key]);
			}
		}
	}

	// Убирает теги HTML, PHP и лишние пробелы из $ _POST
	public static function defensePost()
	{
		foreach ($_POST as $key => $value) {
			if (is_array($_POST[$key])) {
				array_walk_recursive($_POST[$key], "Core\Defender::shieldString");
			} else {
				static::shieldString($_POST[$key]);
			}
		}
	}

	//Генерирация "токена" для csrf-защиты с использованием секретного ключа в config.php, логина пользователя и текущего времени
	public static function getToken()
	{
		$hash = sha1(SECURITY_SECRET . $_SESSION['user']);
		$token = $hash . dechex(time());

		return $token;
	}

	//Проверка "токена" в $ _POST ('csrf') и остановка выполнения скрипта, если "токен" недействителен
	public static function validateToken()
	{
		$token = $_POST['csrf'];

		$hash = @mb_substr($token, 0, 40);
		$expectedHash = sha1(SECURITY_SECRET . $_SESSION['user']);
		$time = @(int)hexdec((mb_substr($token, 40)));

		if (!$token || ($hash !== $expectedHash) || time() - $time >  SECURITY_TOKEN_LIFETIME) {
			$_SESSION['role'] = 'Guest';
			$_SESSION['user'] = 'Гость';
			$_SESSION['userID'] = null;
			Utils::writeLog('Bad token', "recived hash: $hash, excepted hash: $expectedHash. Token age: " . (time() - $time) . ' sec');
			header("Location: /");
			die();
		};
	}
}
