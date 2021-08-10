<?php

namespace Post\Sign;

use Core\Database;
use Core\Utils;

class SignInModel
{
	public function run()
	{
		$login = $_POST['login'];
		$password = $_POST['password'];

		if (!($login && $password)) {
			$_SESSION['message'] = 'Введите логин и пароль';
			return;
		}

		if ($login == SECURITY_ADMIN_LOGIN && $password = SECURITY_ADMIN_PASSWORD) {
			$_SESSION['user'] = $login;
			$_SESSION['userID'] = '0';
			$_SESSION['role'] = 'Admin';
			$_SESSION['userStatus'] = 2;
			return;
		}

		try {
			$db = new Database();
			$sqlFindUser = <<<SQL_USER_FIND
                SELECT `id`, `login`, `password`, `role`, `status`
                FROM Users
                WHERE `login` = :login
SQL_USER_FIND;
			$values = [
				":login" => $login
			];
			$user = $db->select($sqlFindUser, $values);

			if (empty($user)) {
				Utils::message("Пользователя $login не существует");
				return;
			}

			if (!password_verify($password, $user->password)) {
				Utils::message("Неверный пароль");
				return;
			} else {
				$_SESSION['user'] = $user->login;
				$_SESSION['userID'] = $user->id;
				$_SESSION['role'] = $user->role;
				$_SESSION['userStatus'] = $user->status;
				Utils::message("Добро пожаловать, $login!");
			}
		} catch (\Exception $e) {
			Utils::message("Что-то пошло не так! Попробуйте еще раз");
			header("Refresh:0");
			die();
		}
	}
}
