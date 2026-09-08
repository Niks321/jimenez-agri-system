<?php

final class InputSanitizer
{
	public function email(mixed $value): string
	{
		$email = trim((string) $value);
		return filter_var($email, FILTER_VALIDATE_EMAIL) ? strtolower($email) : '';
	}

	public function password(mixed $value): string
	{
		$password = (string) $value;
		return strlen($password) <= 256 ? $password : '';
	}

	public function honeypot(mixed $value): string
	{
		$value = trim((string) $value);
		return strlen($value) <= 100 ? $value : '__invalid_honeypot__';
	}
}
