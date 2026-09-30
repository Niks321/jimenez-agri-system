<?php

require_once __DIR__ . '/../security/SessionSecurity.php';
require_once __DIR__ . '/../security/DepartmentIdentity.php';

final class RoleMiddleware
{
	public function requireRole(string $role): void
	{
		call_user_func(['SessionSecurity', 'start']);
		call_user_func(['SessionSecurity', 'preventCaching']);

		$authenticated = ($_SESSION['authenticated'] ?? false) === true;
		$currentRole = $_SESSION['user']['role'] ?? null;
		$currentDepartment = $_SESSION['user']['department'] ?? null;
		if (!$authenticated || !is_string($currentRole) || !DepartmentIdentity::isValid($currentRole, $currentDepartment)) {
			header('Location: login.php', true, 303);
			exit;
		}

		if (!hash_equals($role, $currentRole)) {
			header('Location: 403.php', true, 303);
			exit;
		}
	}

	public function requireDepartment(string $department): void
	{
		$this->requireRole('staff');

		$currentDepartment = $_SESSION['user']['department'] ?? null;
		if (!is_string($currentDepartment) || !hash_equals($department, $currentDepartment)) {
			header('Location: 403.php', true, 303);
			exit;
		}
	}
}
