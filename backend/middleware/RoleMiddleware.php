<?php

require_once __DIR__ . '/../security/SessionSecurity.php';

final class RoleMiddleware
{
	public function requireRole(string $role): void
	{
		call_user_func(['SessionSecurity', 'start']);
		call_user_func(['SessionSecurity', 'preventCaching']);

		$authenticated = ($_SESSION['authenticated'] ?? false) === true;
		$currentRole = $_SESSION['user']['role'] ?? null;
		if (!$authenticated || !is_string($currentRole)) {
			header('Location: login.php', true, 303);
			exit;
		}

		if (!hash_equals($role, $currentRole)) {
			header('Location: 403.php', true, 303);
			exit;
		}
	}
}