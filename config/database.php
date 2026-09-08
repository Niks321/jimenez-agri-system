<?php

$environmentFile = __DIR__ . '/../.env';
if (is_readable($environmentFile)) {
	foreach (file($environmentFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
		$line = trim($line);
		if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
			continue;
		}

		[$name, $value] = explode('=', $line, 2);
		$name = trim($name);
		$value = trim(trim($value), "\"'");
		if ($name !== '' && getenv($name) === false) {
			putenv($name . '=' . $value);
		}
	}
}

return [
	'host' => getenv('DB_HOST') ?: '127.0.0.1',
	'port' => getenv('DB_PORT') ?: '3306',
	'database' => getenv('DB_DATABASE') ?: 'jimenez_agri_system',
	'username' => getenv('DB_USERNAME') ?: 'root',
	'password' => getenv('DB_PASSWORD') ?: '',
	'charset' => 'utf8mb4',
];
