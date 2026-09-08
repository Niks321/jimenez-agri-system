<?php

final class Database
{
	private ?PDO $connection = null;

	public function connection(): PDO
	{
		if ($this->connection instanceof PDO) {
			return $this->connection;
		}

		$config = require __DIR__ . '/../../config/database.php';
		$dsn = sprintf(
			'mysql:host=%s;port=%s;dbname=%s;charset=%s',
			$config['host'],
			$config['port'],
			$config['database'],
			$config['charset']
		);

		$this->connection = new PDO($dsn, $config['username'], $config['password'], [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,
		]);

		return $this->connection;
	}
}
