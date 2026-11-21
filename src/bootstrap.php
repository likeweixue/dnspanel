<?php

declare(strict_types=1);

const ROOT_PATH = __DIR__ . '/..';
const STORAGE_PATH = ROOT_PATH . '/storage';

ini_set('display_errors', '0');
ini_set('log_errors', '1');
date_default_timezone_set('UTC');

$https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443);

ini_set('session.use_strict_mode', '1');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => $https,
    'httponly' => true,
    'samesite' => 'Lax',
]);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!headers_sent()) {
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self'; form-action 'self'; frame-ancestors 'none'; base-uri 'self'; object-src 'none'");
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: same-origin');
}

require_once ROOT_PATH . '/src/JsonStore.php';
require_once ROOT_PATH . '/src/app.php';
require_once ROOT_PATH . '/src/views.php';

if (!isset($_SESSION['locale']) || !in_array($_SESSION['locale'], ['zh-CN', 'en'], true)) {
    $_SESSION['locale'] = 'zh-CN';
}
if (!isset($_SESSION['csrf']) || !is_string($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

set_exception_handler(static function (Throwable $exception): void {
    error_log($exception);
    if (!headers_sent()) {
        http_response_code(500);
        header('Content-Type: text/plain; charset=UTF-8');
    }
    echo currentLocale() === 'en' ? 'Internal server error.' : '服务器内部错误，请稍后重试。';
});

function currentLocale(): string
{
    return $_SESSION['locale'] ?? 'zh-CN';
}

function csrfToken(): string
{
    return $_SESSION['csrf'];
}

function verifyCsrf(): void
{
    $token = $_POST['csrf'] ?? '';
    if (!is_string($token) || !hash_equals(csrfToken(), $token)) {
        http_response_code(400);
        exit(t('csrf_error'));
    }
}

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
