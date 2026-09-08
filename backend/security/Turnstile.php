<?php

final class Turnstile
{
    private const VERIFY_URL = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    public function siteKey(): string
    {
        $config = require __DIR__ . '/../../config/security.php';
        return (string) $config['turnstile_site_key'];
    }

    public function verify(string $token): bool
    {
        $config = require __DIR__ . '/../../config/security.php';
        $secret = (string) $config['turnstile_secret_key'];

        if ($secret === '' || $token === '' || strlen($token) > 2048) {
            return false;
        }

        $payload = [
            'secret' => $secret,
            'response' => $token,
        ];
        $remoteIp = $_SERVER['REMOTE_ADDR'] ?? '';
        if ($remoteIp !== '') {
            $payload['remoteip'] = $remoteIp;
        }

        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($payload),
                'timeout' => 10,
                'ignore_errors' => true,
            ],
        ]);
        $response = @file_get_contents(self::VERIFY_URL, false, $context);
        if ($response === false) {
            return false;
        }

        $result = json_decode($response, true);
        return is_array($result) && ($result['success'] ?? false) === true;
    }
}