<?php

namespace Core;

class Utils
{
	//Проверка, относится ли запрос к AJAX
	public static function isAjax()
	{
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') return true;
		return false;
	}

	//Отправка сообщения клиенту
	public static function message($message)
	{
		if (Utils::isAjax()) {
			global $AJAXJSON;
			$AJAXJSON['message'] = $message;
			static::responseAjax();
		} else {
			$_SESSION['message'] = $message;
		}
	}

	// ответ на AJAX-запрос
	public static function responseAjax($body = null)
	{
		global $AJAXJSON;
		$AJAXJSON['body'] = $body;
		header('Content-Type: application/json');
		echo json_encode($AJAXJSON);
	}

	//Запись события в log
	public static function writeLog(string $event, string $text)
	{
		$date = date('Y-m-d H:i:s');
		$log = $date . " [$event]: " . $text . PHP_EOL;
		$file = fopen(LOGS . date('Y-m-d') . ".txt", 'a');
		fwrite($file, $log);
		fclose($file);
	}

	//Возвращает текущую дату
	public static function getCurrentDate()
	{
		return date('Y-m-d', time());
	}
}
