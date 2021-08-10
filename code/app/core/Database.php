<?php

namespace Core;

use Core\Utils;

class Database
{
	public function __construct()
	{
		$this->pdo = new \PDO(PDO_DBMS . ':host=' . PDO_HOST . ';dbname=' . PDO_BASE, PDO_USER, PDO_PASS, PDO_OPTION);
	}

	//SQL-запросы
	private function query(string $sql, array $values = [])
	{
		$stmt = $this->pdo->prepare($sql);
		foreach ($values as $key => $value) {
			$stmt->bindValue($key, "{$value}");
		}

		if (!$stmt) {
			Utils::writeLog('PDOStatement', $this->pdo->errorInfo()[2]);
		}

		$status = $stmt->execute();

		if (!$status) {
			Utils::message('Ошибка соединения с БД');
			return;
		}

		return $stmt;
	}

	//возвращает первую строку SQL-запроса
	public function select(string $sql, array $values  = [])
	{
		$stmt = $this->query($sql, $values);
		if ($stmt) {
			$row = $stmt->fetch();
			$stmt->closeCursor();
			return $row;
		}
	}

	//возвращает все строки SQL-запроса
	public function selectAll(string $sql, array $values  = [])
	{
		$stmt = $this->query($sql, $values);
		if ($stmt) return $stmt->fetchAll();
	}

	//возвращает количество строк SQL-запроса
	public function update(string $sql, array $values  = [])
	{
		$stmt = $this->query($sql, $values);
		if ($stmt) return $stmt->rowCount();
	}

	//возвращает ID последней строки SQL-запроса
	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}
}
