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
		$value = trim($value);
		$value = trim($value, "\"'");
		if ($name !== '' && getenv($name) === false) {
			putenv($name . '=' . $value);
		}
	}
}

return [
	'app_key' => getenv('APP_KEY') ?: 'change-this-development-key-before-production',
	// Set these to the real keys from the Cloudflare Turnstile dashboard.
	'turnstile_site_key' => getenv('TURNSTILE_SITE_KEY') ?: '',
	'turnstile_secret_key' => getenv('TURNSTILE_SECRET_KEY') ?: '',
];
