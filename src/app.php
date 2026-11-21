<?php

declare(strict_types=1);

function store(): JsonStore
{
    static $store = null;
    if (!$store instanceof JsonStore) {
        $store = new JsonStore(STORAGE_PATH);
    }

    return $store;
}

function nowUtc(): string
{
    return gmdate('Y-m-d\TH:i:s\Z');
}

function newId(string $prefix): string
{
    return $prefix . '_' . bin2hex(random_bytes(8));
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function pullFlash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return is_array($flash) ? $flash : null;
}

function currentUser(): ?array
{
    $userId = $_SESSION['user_id'] ?? null;
    if (!is_string($userId)) {
        return null;
    }

    $document = store()->read('users.json', 'users');
    foreach ($document['users'] as $user) {
        if ($user['id'] === $userId && $user['status'] === 'active') {
            return $user;
        }
    }

    unset($_SESSION['user_id']);
    session_regenerate_id(true);
    return null;
}

function registerUser(array $input): array
{
    $username = trim((string) ($input['username'] ?? ''));
    $password = (string) ($input['password'] ?? '');
    $confirmation = (string) ($input['password_confirmation'] ?? '');

    if (!preg_match('/^[A-Za-z0-9_][A-Za-z0-9_.-]{2,31}$/', $username)) {
        throw new DomainException(t('username_invalid'));
    }
    if (strlen($password) < 8 || strlen($password) > 128) {
        throw new DomainException(t('password_invalid'));
    }
    if (!hash_equals($password, $confirmation)) {
        throw new DomainException(t('password_mismatch'));
    }

    $normalized = strtolower($username);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $user = store()->transaction(
        ['users.json' => 'users'],
        static function (array &$documents) use ($username, $normalized, $passwordHash): array {
            $users = &$documents['users.json']['users'];
            foreach ($users as $existing) {
                if ($existing['username_normalized'] === $normalized) {
                    throw new DomainException(t('username_taken'));
                }
            }

            $timestamp = nowUtc();
            $user = [
                'id' => newId('usr'),
                'username' => $username,
                'username_normalized' => $normalized,
                'password_hash' => $passwordHash,
                'role' => count($users) === 0 ? 'admin' : 'user',
                'status' => 'active',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
            $users[] = $user;

            return $user;
        }
    );

    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['csrf'] = bin2hex(random_bytes(32));

    return $user;
}

function loginUser(array $input): array
{
    $username = strtolower(trim((string) ($input['username'] ?? '')));
    $password = (string) ($input['password'] ?? '');
    $document = store()->read('users.json', 'users');
    $found = null;

    foreach ($document['users'] as $user) {
        if ($user['username_normalized'] === $username) {
            $found = $user;
            break;
        }
    }

    if ($found === null || !password_verify($password, $found['password_hash'])) {
        throw new DomainException(t('login_invalid'));
    }
    if ($found['status'] !== 'active') {
        throw new DomainException(t('account_disabled'));
    }

    if (password_needs_rehash($found['password_hash'], PASSWORD_DEFAULT)) {
        $newHash = password_hash($password, PASSWORD_DEFAULT);
        store()->transaction(
            ['users.json' => 'users'],
            static function (array &$documents) use ($found, $newHash): void {
                foreach ($documents['users.json']['users'] as &$user) {
                    if ($user['id'] === $found['id'] && $user['status'] === 'active') {
                        $user['password_hash'] = $newHash;
                        $user['updated_at'] = nowUtc();
                        break;
                    }
                }
                unset($user);
            }
        );
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = $found['id'];
    $_SESSION['csrf'] = bin2hex(random_bytes(32));

    return $found;
}

function logoutUser(): void
{
    unset($_SESSION['user_id']);
    session_regenerate_id(true);
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

function listUsers(): array
{
    $users = store()->read('users.json', 'users')['users'];
    usort($users, static fn (array $a, array $b): int => strcmp($b['created_at'], $a['created_at']));
    return $users;
}

function updateUserStatus(string $adminId, string $userId, string $status): void
{
    if (!in_array($status, ['active', 'disabled'], true)) {
        throw new DomainException(t('user_status_invalid'));
    }

    store()->transaction(
        ['users.json' => 'users'],
        static function (array &$documents) use ($adminId, $userId, $status): void {
            foreach ($documents['users.json']['users'] as &$user) {
                if ($user['id'] !== $userId) {
                    continue;
                }
                if ($user['role'] === 'admin' || $user['id'] === $adminId) {
                    throw new DomainException(t('admin_locked'));
                }
                $user['status'] = $status;
                $user['updated_at'] = nowUtc();
                return;
            }
            unset($user);
            throw new DomainException(t('user_not_found'));
        }
    );
}

function validHostnameLabel(string $label): bool
{
    return strlen($label) <= 63
        && preg_match('/^[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?$/', $label) === 1;
}

function normalizeDnsName(string $value): ?string
{
    $value = rtrim(strtolower(trim($value)), '.');
    if (strlen($value) > 253 || !preg_match('/^[a-z0-9.-]+$/', $value)) {
        return null;
    }

    $labels = explode('.', $value);
    if (count($labels) < 2) {
        return null;
    }
    foreach ($labels as $label) {
        if (!validHostnameLabel($label)) {
            return null;
        }
    }

    return $value;
}

function createDomain(string $input): array
{
    $suffix = normalizeDnsName($input);
    if ($suffix === null) {
        throw new DomainException(t('domain_invalid'));
    }

    return store()->transaction(
        ['domains.json' => 'domains'],
        static function (array &$documents) use ($suffix): array {
            foreach ($documents['domains.json']['domains'] as $domain) {
                if ($domain['suffix'] === $suffix) {
                    throw new DomainException(t('domain_exists'));
                }
            }

            $timestamp = nowUtc();
            $domain = [
                'id' => newId('dom'),
                'suffix' => $suffix,
                'enabled' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
            $documents['domains.json']['domains'][] = $domain;
            return $domain;
        }
    );
}

function listDomains(bool $enabledOnly = false): array
{
    $domains = store()->read('domains.json', 'domains')['domains'];
    if ($enabledOnly) {
        $domains = array_values(array_filter($domains, static fn (array $domain): bool => $domain['enabled'] === true));
    }
    usort($domains, static fn (array $a, array $b): int => strcmp($a['suffix'], $b['suffix']));
    return $domains;
}

function updateDomainStatus(string $domainId, string $status): void
{
    if (!in_array($status, ['enabled', 'disabled'], true)) {
        throw new DomainException(t('domain_status_invalid'));
    }

    store()->transaction(
        ['domains.json' => 'domains'],
        static function (array &$documents) use ($domainId, $status): void {
            foreach ($documents['domains.json']['domains'] as &$domain) {
                if ($domain['id'] === $domainId) {
                    $domain['enabled'] = $status === 'enabled';
                    $domain['updated_at'] = nowUtc();
                    return;
                }
            }
            unset($domain);
            throw new DomainException(t('domain_not_found'));
        }
    );
}

function utf8Length(string $value): ?int
{
    if (preg_match('//u', $value) !== 1) {
        return null;
    }
    if (function_exists('mb_strlen')) {
        return mb_strlen($value, 'UTF-8');
    }

    $length = preg_match_all('/./us', $value, $matches);
    return $length === false ? null : $length;
}

function validatePurpose(string $purpose, bool $required = true): string
{
    $purpose = trim($purpose);
    $length = utf8Length($purpose);
    if ($length === null || ($required && $length === 0) || $length > 500) {
        throw new DomainException(t('purpose_invalid'));
    }

    return $purpose;
}

function createDnsRequest(string $userId, array $input): array
{
    $hostname = strtolower(trim((string) ($input['hostname'] ?? '')));
    $recordType = strtoupper(trim((string) ($input['record_type'] ?? '')));
    $recordValue = trim((string) ($input['record_value'] ?? ''));
    $domainId = (string) ($input['domain_id'] ?? '');
    $purpose = validatePurpose((string) ($input['purpose'] ?? ''));

    if (!validHostnameLabel($hostname)) {
        throw new DomainException(t('hostname_invalid'));
    }
    if (!in_array($recordType, ['A', 'AAAA', 'CNAME', 'TXT'], true)) {
        throw new DomainException(t('record_type_invalid'));
    }

    return store()->transaction(
        ['users.json' => 'users', 'domains.json' => 'domains', 'requests.json' => 'requests'],
        static function (array &$documents) use ($userId, $domainId, $hostname, $recordType, $recordValue, $purpose): array {
            $activeUser = false;
            foreach ($documents['users.json']['users'] as $user) {
                if ($user['id'] === $userId && $user['status'] === 'active') {
                    $activeUser = true;
                    break;
                }
            }
            if (!$activeUser) {
                throw new DomainException(t('account_disabled'));
            }

            $selectedDomain = null;
            foreach ($documents['domains.json']['domains'] as $domain) {
                if ($domain['id'] === $domainId && $domain['enabled'] === true) {
                    $selectedDomain = $domain;
                    break;
                }
            }
            if ($selectedDomain === null) {
                throw new DomainException(t('domain_not_available'));
            }

            $fqdn = $hostname . '.' . $selectedDomain['suffix'];
            if (strlen($fqdn) > 253) {
                throw new DomainException(t('hostname_invalid'));
            }
            $normalizedValue = $recordValue;

            if ($recordType === 'A' && filter_var($recordValue, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false) {
                throw new DomainException(t('ipv4_invalid'));
            }
            if ($recordType === 'AAAA' && filter_var($recordValue, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
                throw new DomainException(t('ipv6_invalid'));
            }
            if ($recordType === 'CNAME') {
                $normalizedValue = normalizeDnsName($recordValue);
                if ($normalizedValue === null) {
                    throw new DomainException(t('cname_invalid'));
                }
                if ($normalizedValue === $fqdn) {
                    throw new DomainException(t('cname_self'));
                }
            }
            if ($recordType === 'TXT') {
                if (
                    strlen($recordValue) < 1
                    || strlen($recordValue) > 255
                    || str_contains($recordValue, "\0")
                    || str_contains($recordValue, "\r")
                    || str_contains($recordValue, "\n")
                    || preg_match('//u', $recordValue) !== 1
                ) {
                    throw new DomainException(t('txt_invalid'));
                }
            }

            foreach ($documents['requests.json']['requests'] as $existing) {
                if (
                    $existing['fqdn'] === $fqdn
                    && in_array($existing['review_status'], ['pending', 'approved'], true)
                ) {
                    throw new DomainException(t('hostname_taken'));
                }
            }

            $timestamp = nowUtc();
            $request = [
                'id' => newId('req'),
                'user_id' => $userId,
                'domain_id' => $selectedDomain['id'],
                'hostname' => $hostname,
                'fqdn' => $fqdn,
                'record_type' => $recordType,
                'record_value' => $normalizedValue,
                'purpose' => $purpose,
                'review_status' => 'pending',
                'resolution_status' => null,
                'review_note' => '',
                'reviewed_by' => null,
                'reviewed_at' => null,
                'resolved_by' => null,
                'resolved_at' => null,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
            $documents['requests.json']['requests'][] = $request;

            return $request;
        }
    );
}

function decorateRequests(array $requests, array $domains, array $users = []): array
{
    $domainMap = [];
    foreach ($domains as $domain) {
        $domainMap[$domain['id']] = $domain['suffix'];
    }
    $userMap = [];
    foreach ($users as $user) {
        $userMap[$user['id']] = $user['username'];
    }

    foreach ($requests as &$request) {
        $request['suffix'] = $domainMap[$request['domain_id']] ?? '';
        $request['username'] = $userMap[$request['user_id']] ?? '—';
    }
    unset($request);

    usort($requests, static fn (array $a, array $b): int => strcmp($b['created_at'], $a['created_at']));
    return $requests;
}

function requestsForUser(string $userId): array
{
    $requests = array_values(array_filter(
        store()->read('requests.json', 'requests')['requests'],
        static fn (array $request): bool => $request['user_id'] === $userId
    ));
    $domains = store()->read('domains.json', 'domains')['domains'];
    return decorateRequests($requests, $domains);
}

function allRequests(): array
{
    return decorateRequests(
        store()->read('requests.json', 'requests')['requests'],
        store()->read('domains.json', 'domains')['domains'],
        store()->read('users.json', 'users')['users']
    );
}

function reviewRequest(string $adminId, string $requestId, string $action, string $note): void
{
    if (!in_array($action, ['approve', 'reject'], true)) {
        throw new DomainException(t('review_action_invalid'));
    }
    $note = validatePurpose($note, false);

    store()->transaction(
        ['requests.json' => 'requests'],
        static function (array &$documents) use ($adminId, $requestId, $action, $note): void {
            foreach ($documents['requests.json']['requests'] as &$request) {
                if ($request['id'] !== $requestId) {
                    continue;
                }
                if ($request['review_status'] !== 'pending') {
                    throw new DomainException(t('request_already_reviewed'));
                }

                $timestamp = nowUtc();
                $request['review_status'] = $action === 'approve' ? 'approved' : 'rejected';
                $request['resolution_status'] = $action === 'approve' ? 'pending' : null;
                $request['review_note'] = $note;
                $request['reviewed_by'] = $adminId;
                $request['reviewed_at'] = $timestamp;
                $request['updated_at'] = $timestamp;
                return;
            }
            unset($request);
            throw new DomainException(t('request_not_found'));
        }
    );
}

function resolveRequest(string $adminId, string $requestId): void
{
    store()->transaction(
        ['requests.json' => 'requests'],
        static function (array &$documents) use ($adminId, $requestId): void {
            foreach ($documents['requests.json']['requests'] as &$request) {
                if ($request['id'] !== $requestId) {
                    continue;
                }
                if ($request['review_status'] !== 'approved' || $request['resolution_status'] !== 'pending') {
                    throw new DomainException(t('request_not_resolvable'));
                }

                $timestamp = nowUtc();
                $request['resolution_status'] = 'resolved';
                $request['resolved_by'] = $adminId;
                $request['resolved_at'] = $timestamp;
                $request['updated_at'] = $timestamp;
                return;
            }
            unset($request);
            throw new DomainException(t('request_not_found'));
        }
    );
}
