<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../security/PasswordHasher.php';
require_once __DIR__ . '/../security/DepartmentIdentity.php';

final class AuthService
{
	public function __construct(
		private Database $database,
		private PasswordHasher $passwordHasher
	) {
	}

	public function authenticate(string $email, string $password): ?array
	{
		$connection = $this->database->connection();
		$statement = $connection->prepare(
			'SELECT id, username, email, password_hash, full_name, role, department '
			. 'FROM users WHERE email = :email AND status = :status LIMIT 1'
		);
		$statement->execute(['email' => $email, 'status' => 'active']);
		$user = $statement->fetch();

		if (!is_array($user) || !$this->passwordHasher->verify($password, (string) $user['password_hash'])) {
			return null;
		}
		if (!DepartmentIdentity::isValid((string) $user['role'], $user['department'] ?? null)) {
			return null;
		}

		$update = $connection->prepare('UPDATE users SET last_login_at = NOW() WHERE id = :id');
		$update->execute(['id' => $user['id']]);

		return [
			'id' => (int) $user['id'],
			'full_name' => (string) $user['full_name'],
			'role' => (string) $user['role'],
			'department' => $user['department'] ?: null,
		];
	}
}
