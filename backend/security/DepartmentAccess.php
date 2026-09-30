<?php

require_once __DIR__ . '/DepartmentIdentity.php';
require_once __DIR__ . '/SessionSecurity.php';

/** Backend data boundary. Every department service/repository must use this before touching data. */
final class DepartmentAccess
{
	public static function require(string $department): void
	{
		if (!DepartmentIdentity::allows($department)) {
			throw new InvalidArgumentException('Unknown department.');
		}

		SessionSecurity::start();
		if (($_SESSION['authenticated'] ?? false) !== true) {
			throw new RuntimeException('A signed-in workspace identity is required.');
		}
		$user = $_SESSION['user'] ?? null;
		$role = is_array($user) ? ($user['role'] ?? '') : '';
		$assignedDepartment = is_array($user) ? ($user['department'] ?? null) : null;

		if (!is_string($role) || !DepartmentIdentity::isValid($role, $assignedDepartment)) {
			throw new RuntimeException('A valid workspace identity is required.');
		}

		if ($role === 'administrator') {
			return;
		}

		if (!hash_equals($department, (string) $assignedDepartment)) {
			throw new RuntimeException('This department cannot access the requested data.');
		}
	}

	public static function requireAdministrator(): void
	{
		SessionSecurity::start();
		if (($_SESSION['authenticated'] ?? false) !== true) {
			throw new RuntimeException('A signed-in administrator is required.');
		}
		$user = $_SESSION['user'] ?? null;
		if (!is_array($user)
			|| ($user['role'] ?? null) !== 'administrator'
			|| !DepartmentIdentity::isValid('administrator', $user['department'] ?? null)) {
			throw new RuntimeException('Administrator access is required.');
		}
	}
}
