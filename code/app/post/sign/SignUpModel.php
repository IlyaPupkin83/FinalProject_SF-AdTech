<?php

namespace Post\Sign;

use Core\Database;
use Core\Utils;

class SignUpModel
{
	public function run()
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$role = $_POST['role'];

		if (!$login) {
			Utils::message('Введите логин');
			return;
		}

		if ($login == SECURITY_ADMIN_LOGIN) {
			Utils::message("Пользователь $login уже существует");
			return;
		}

		if (!$email) {
			Utils::message('Введите пароль');
			return;
		}

		if (!$email) {
			Utils::message('Введите E-mail');
			return;
		}

		if (!$role || (($role !== 'Webmaster') && ($role !== "Advertiser"))) {
			Utils::message('Выберите роль');
			return;
		}

		try {

			$db = new Database();
			$sqlFindUser = <<<SQL_FIND_USER
                SELECT `login`, `email`
                FROM Users
                WHERE `login` = :login OR `email` = :email
SQL_FIND_USER;
			$values = [
				":login" => $login,
				":email" => $email
			];

			$result = $db->select($sqlFindUser, $values);

			if ($result->login == $login) {
				Utils::message("Пользователь $login уже существует");
				return;
			}

			if ($result->email == $email) {
				Utils::message("$email занят");
				return;
			}

			$password = password_hash($password, PASSWORD_DEFAULT);

			$sqlCreateUser = <<<SQL_CREATE_USER
                INSERT INTO Users (login, password, email, role)
                VALUES (:login, :password, :email, :role)
SQL_CREATE_USER;
			$values = [
				":login" => $login,
				":password" => $password,
				":email" => $email,
				":role" => $role
			];

			$result = $db->update($sqlCreateUser, $values);

			if ($result == 1) {
				Utils::message("Регистрация завершена");
			} else {
				Utils::message("Что-то пошло не так");
			}
		} catch (\Exception $e) {
			Utils::message("Что-то пошло не так! Попробуйте еще раз");
			header("Refresh:0");
			die();
		}
	}
}
