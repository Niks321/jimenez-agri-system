<?php

final class PasswordHasher
{
	public function verify(string $password, string $hash): bool
	{
		return password_verify($password, $hash);
	}
}
