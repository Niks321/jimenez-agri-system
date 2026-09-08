<?php

require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../security/Csrf.php';
require_once __DIR__ . '/../security/InputSanitizer.php';
require_once __DIR__ . '/../security/SessionSecurity.php';
require_once __DIR__ . '/../security/Turnstile.php';

final class AuthController
{
	public function __construct(
		private AuthService $authService,
		private InputSanitizer $inputSanitizer,
		private Csrf $csrf,
		private Turnstile $turnstile
	) {
	}

	public function login(array $input, bool $turnstileConfigured): ?string
	{
		if (!$this->csrf->valid($input['_csrf_token'] ?? null)) {
			return 'Your form session expired. Please refresh and try again.';
		}

		$email = $this->inputSanitizer->email($input['email'] ?? null);
		$password = $this->inputSanitizer->password($input['password'] ?? null);
		$turnstileProof = $turnstileConfigured
			&& $this->turnstile->verify((string) ($input['cf-turnstile-response'] ?? ''));
		$localHumanCheck = !$turnstileConfigured
			&& ($input['anti_bot'] ?? null) === 'on';
		$honeypot = $this->inputSanitizer->honeypot($input['website'] ?? null);

		if ($email === '' || $password === '' || ((!$turnstileProof && !$localHumanCheck) || $honeypot !== '')) {
			return 'Please complete the human verification before signing in.';
		}

		$user = $this->authService->authenticate($email, $password);
		if ($user === null) {
			return 'The email or password is incorrect.';
		}

		session_regenerate_id(true);
		$_SESSION['user'] = $user;
		$_SESSION['authenticated'] = true;
		return null;
	}

	public function dashboardPath(): string
	{
		return match ($_SESSION['user']['role'] ?? '') {
			'administrator' => 'admin-dashboard.php',
			'staff' => 'personnel-dashboard.php',
			default => '403.php',
		};
	}
}
