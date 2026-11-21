<?php

declare(strict_types=1);

if (PHP_SAPI === 'cli-server') {
    $assetPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $assetsRoot = realpath(__DIR__ . '/assets');
    $assetFile = is_string($assetPath) ? realpath(__DIR__ . $assetPath) : false;
    if (
        $assetsRoot !== false
        && $assetFile !== false
        && str_starts_with($assetFile, $assetsRoot . DIRECTORY_SEPARATOR)
        && is_file($assetFile)
    ) {
        return false;
    }
}

require_once dirname(__DIR__) . '/src/bootstrap.php';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$route = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$route = is_string($route) ? $route : '/';

if ($method === 'POST') {
    verifyCsrf();
}

$user = currentUser();

function requireUser(?array $user): array
{
    if ($user === null) {
        redirect('/login');
    }
    return $user;
}

function requireAdminUser(?array $user): array
{
    $user = requireUser($user);
    if ($user['role'] !== 'admin') {
        http_response_code(403);
        renderErrorPage('forbidden', $user);
        exit;
    }
    return $user;
}

function requireGuest(?array $user): void
{
    if ($user !== null) {
        redirect('/dashboard');
    }
}

if ($route === '/') {
    if ($method !== 'GET') {
        http_response_code(405);
        exit(t('method_not_allowed'));
    }
    redirect($user === null ? '/login' : '/dashboard');
}

if ($route === '/locale' && $method === 'POST') {
    $locale = $_POST['locale'] ?? '';
    if (!in_array($locale, ['zh-CN', 'en'], true)) {
        http_response_code(400);
        exit('Invalid locale.');
    }
    $_SESSION['locale'] = $locale;
    flash('success', t('locale_updated'));

    $returnTo = $_POST['return_to'] ?? ($user === null ? '/login' : '/dashboard');
    if (!is_string($returnTo) || !preg_match('#^/(?!/)#', $returnTo) || str_contains($returnTo, '\\') || preg_match('/[\r\n]/', $returnTo)) {
        $returnTo = $user === null ? '/login' : '/dashboard';
    }
    redirect($returnTo);
}

if ($route === '/login') {
    requireGuest($user);
    if ($method === 'GET') {
        renderAuthPage('login');
        exit;
    }
    if ($method === 'POST') {
        try {
            loginUser($_POST);
            flash('success', t('login_success'));
            redirect('/dashboard');
        } catch (DomainException $exception) {
            http_response_code(422);
            renderAuthPage('login', ['username' => $_POST['username'] ?? ''], $exception->getMessage());
            exit;
        }
    }
}

if ($route === '/register') {
    requireGuest($user);
    if ($method === 'GET') {
        renderAuthPage('register');
        exit;
    }
    if ($method === 'POST') {
        try {
            $registered = registerUser($_POST);
            flash('success', t($registered['role'] === 'admin' ? 'registered_admin' : 'registered_user'));
            redirect('/dashboard');
        } catch (DomainException $exception) {
            http_response_code(422);
            renderAuthPage('register', ['username' => $_POST['username'] ?? ''], $exception->getMessage());
            exit;
        }
    }
}

if ($route === '/logout' && $method === 'POST') {
    requireUser($user);
    logoutUser();
    flash('success', t('logout_success'));
    redirect('/login');
}

if ($route === '/dashboard' && $method === 'GET') {
    $user = requireUser($user);
    renderDashboard($user, requestsForUser($user['id']));
    exit;
}

if ($route === '/requests/new' && $method === 'GET') {
    $user = requireUser($user);
    renderNewRequest($user, listDomains(true));
    exit;
}

if ($route === '/requests' && $method === 'POST') {
    $user = requireUser($user);
    try {
        createDnsRequest($user['id'], $_POST);
        flash('success', t('request_created'));
        redirect('/dashboard');
    } catch (DomainException $exception) {
        http_response_code(422);
        renderNewRequest($user, listDomains(true), $_POST, $exception->getMessage());
        exit;
    }
}

if ($route === '/admin/users' && $method === 'GET') {
    $admin = requireAdminUser($user);
    renderAdminUsers($admin, listUsers());
    exit;
}

if ($route === '/admin/users/status' && $method === 'POST') {
    $admin = requireAdminUser($user);
    try {
        updateUserStatus($admin['id'], (string) ($_POST['user_id'] ?? ''), (string) ($_POST['status'] ?? ''));
        flash('success', t('user_status_updated'));
    } catch (DomainException $exception) {
        flash('error', $exception->getMessage());
    }
    redirect('/admin/users');
}

if ($route === '/admin/domains' && $method === 'GET') {
    $admin = requireAdminUser($user);
    renderAdminDomains($admin, listDomains());
    exit;
}

if ($route === '/admin/domains/create' && $method === 'POST') {
    $admin = requireAdminUser($user);
    try {
        createDomain((string) ($_POST['suffix'] ?? ''));
        flash('success', t('domain_created'));
        redirect('/admin/domains');
    } catch (DomainException $exception) {
        http_response_code(422);
        renderAdminDomains($admin, listDomains(), ['suffix' => $_POST['suffix'] ?? ''], $exception->getMessage());
        exit;
    }
}

if ($route === '/admin/domains/status' && $method === 'POST') {
    requireAdminUser($user);
    try {
        updateDomainStatus((string) ($_POST['domain_id'] ?? ''), (string) ($_POST['status'] ?? ''));
        flash('success', t('domain_status_updated'));
    } catch (DomainException $exception) {
        flash('error', $exception->getMessage());
    }
    redirect('/admin/domains');
}

if ($route === '/admin/requests' && $method === 'GET') {
    $admin = requireAdminUser($user);
    $filter = $_GET['status'] ?? 'all';
    if (!is_string($filter) || !in_array($filter, ['all', 'pending', 'approved', 'resolved', 'rejected'], true)) {
        $filter = 'all';
    }
    renderAdminRequests($admin, allRequests(), $filter);
    exit;
}

if ($route === '/admin/requests/review' && $method === 'POST') {
    $admin = requireAdminUser($user);
    $action = (string) ($_POST['action'] ?? '');
    try {
        reviewRequest($admin['id'], (string) ($_POST['request_id'] ?? ''), $action, (string) ($_POST['review_note'] ?? ''));
        flash('success', t($action === 'approve' ? 'review_approved' : 'review_rejected'));
    } catch (DomainException $exception) {
        flash('error', $exception->getMessage());
    }
    redirect('/admin/requests');
}

if ($route === '/admin/requests/resolve' && $method === 'POST') {
    $admin = requireAdminUser($user);
    try {
        resolveRequest($admin['id'], (string) ($_POST['request_id'] ?? ''));
        flash('success', t('request_resolved'));
    } catch (DomainException $exception) {
        flash('error', $exception->getMessage());
    }
    redirect('/admin/requests');
}

$knownRoutes = [
    '/login', '/register', '/logout', '/dashboard', '/requests/new', '/requests',
    '/admin/users', '/admin/users/status', '/admin/domains', '/admin/domains/create',
    '/admin/domains/status', '/admin/requests', '/admin/requests/review', '/admin/requests/resolve',
];
if (in_array($route, $knownRoutes, true)) {
    http_response_code(405);
    exit(t('method_not_allowed'));
}

http_response_code(404);
renderErrorPage('not_found', $user);
