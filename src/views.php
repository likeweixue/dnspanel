<?php

declare(strict_types=1);

function t(string $key, array $replace = []): string
{
    static $translations = [
        'zh-CN' => [
            'app_tagline' => 'DNS 申请与人工解析面板',
            'nav_workspace' => '工作台',
            'nav_my_requests' => '我的申请',
            'nav_new_request' => '新建申请',
            'nav_admin' => '管理后台',
            'nav_dns_requests' => 'DNS 申请',
            'nav_domains' => '域名管理',
            'nav_users' => '用户管理',
            'manual_mode' => '人工解析模式',
            'manual_mode_text' => '申请通过后，由管理员在 Cloudflare 手动添加记录。',
            'language' => '界面语言',
            'switch_language' => '切换',
            'logout' => '退出登录',
            'admin' => '管理员',
            'user' => '用户',
            'menu' => '打开导航',
            'close_menu' => '关闭导航',
            'login_title' => '登录',
            'login_subtitle' => '登录后查看申请进度或处理解析审核。',
            'register_title' => '创建账号',
            'register_subtitle' => '提交你的第一个二级域名解析愿望。',
            'username' => '用户名',
            'username_hint' => '3–32 位字母、数字、点、下划线或连字符，需以字母、数字或下划线开头。',
            'password' => '密码',
            'password_confirm' => '确认密码',
            'password_hint' => '至少 8 位，最多 128 位。',
            'login' => '登录',
            'register' => '注册',
            'no_account' => '还没有账号？',
            'have_account' => '已经有账号？',
            'first_admin_notice' => '首个成功注册的用户会自动成为管理员，请优先注册并妥善保管账号。',
            'welcome_eyebrow' => 'DNS REQUEST WORKSPACE',
            'auth_hero_title' => '把域名分享出去，把解析掌握在自己手里。',
            'auth_hero_text' => '一个轻量的 DNS 笔记本：收集二级域名申请，完成审核，再由你亲自确认每一次解析。',
            'auth_step_1_title' => '提交解析愿望',
            'auth_step_1_text' => '选择域名后缀，填写记录与真实用途。',
            'auth_step_2_title' => '管理员审核',
            'auth_step_2_text' => '申请与用途清晰可见，避免不明解析。',
            'auth_step_3_title' => '人工确认解析',
            'auth_step_3_text' => '审核和 Cloudflare 操作分开记录，进度更明确。',
            'dashboard_title' => '我的申请',
            'dashboard_greeting' => '你好，:name',
            'dashboard_subtitle' => '在这里查看你的 DNS 申请、审核结果和人工解析进度。',
            'total_requests' => '全部申请',
            'pending_review' => '等待审核',
            'waiting_resolution' => '等待解析',
            'resolved' => '已解析',
            'new_request' => '新建 DNS 申请',
            'requests_empty' => '还没有 DNS 申请',
            'requests_empty_text' => '选择一个域名后缀，提交你的第一条解析记录。',
            'create_first_request' => '创建第一条申请',
            'col_domain' => '完整域名',
            'col_record' => '解析记录',
            'col_purpose' => '用途说明',
            'col_review' => '审核状态',
            'col_resolution' => '解析状态',
            'col_created' => '申请时间',
            'col_user' => '申请用户',
            'col_status' => '状态',
            'col_actions' => '操作',
            'col_role' => '角色',
            'col_username' => '用户名',
            'not_applicable' => '—',
            'status_pending' => '待审核',
            'status_approved' => '已通过',
            'status_rejected' => '已拒绝',
            'resolution_pending' => '待解析',
            'resolution_resolved' => '已解析',
            'review_note' => '审核说明',
            'new_request_title' => '新建 DNS 申请',
            'new_request_subtitle' => '填写一个二级域名和一条解析记录，提交后等待管理员审核。',
            'manual_notice_title' => '这里不会自动修改 DNS',
            'manual_notice_text' => '申请通过后，管理员会到 Cloudflare 手动添加解析，再回到这里标记“已解析”。',
            'domain_suffix' => '域名后缀',
            'select_domain' => '请选择域名',
            'hostname' => '二级域名',
            'hostname_hint' => '只填写 beta 这样的单个标签，不要输入完整域名。允许字母、数字和中间连字符。',
            'record_type' => '记录类型',
            'record_value' => '记录值',
            'purpose' => '用途说明',
            'purpose_hint' => '请说明项目或网站用途，帮助管理员审核，最多 500 字。',
            'submit_request' => '提交申请',
            'record_hint_A' => '填写 IPv4 地址，例如 192.0.2.10。',
            'record_hint_AAAA' => '填写 IPv6 地址，例如 2001:db8::10。',
            'record_hint_CNAME' => '填写目标域名，例如 example.com，不要填写 URL。',
            'record_hint_TXT' => '填写一段 TXT 文本，最多 255 字节，不要换行。',
            'no_domains_title' => '暂时没有可申请的域名',
            'no_domains_text' => '请联系管理员添加或启用域名后缀后再提交申请。',
            'manage_domains' => '管理域名',
            'back_dashboard' => '返回我的申请',
            'users_title' => '用户管理',
            'users_subtitle' => '查看注册用户，并控制普通用户是否可以继续使用面板。',
            'status_active' => '正常',
            'status_disabled' => '已禁用',
            'disable' => '禁用',
            'enable' => '启用',
            'no_users' => '暂无用户。',
            'domains_title' => '域名管理',
            'domains_subtitle' => '配置用户可以选择的域名后缀。禁用后缀不会影响历史申请。',
            'add_domain' => '添加域名',
            'domain_placeholder' => '例如 likeweixue.com',
            'domain_enabled' => '已启用',
            'domain_disabled' => '已禁用',
            'no_domains' => '暂无域名后缀。',
            'dns_requests_title' => 'DNS 申请管理',
            'dns_requests_subtitle' => '审核申请，并在 Cloudflare 手动操作完成后确认解析状态。',
            'filter_all' => '全部',
            'filter_pending' => '待审核',
            'filter_approved' => '待解析',
            'filter_resolved' => '已解析',
            'filter_rejected' => '已拒绝',
            'review' => '审核',
            'approve' => '通过申请',
            'reject' => '拒绝申请',
            'review_note_placeholder' => '可选：填写审核说明',
            'mark_resolved' => '标记已解析',
            'no_requests' => '还没有 DNS 申请。',
            'no_requests_filter' => '当前筛选条件下没有申请。',
            'cloudflare_reminder' => '点击“通过申请”不会修改 Cloudflare。完成手动解析后，请再点击“标记已解析”。',
            'resolved_at' => '解析时间',
            'reviewed_at' => '审核时间',
            'resolve_confirm' => '请确认你已经在 Cloudflare 完成这条记录的手动解析。',
            'disable_confirm' => '确定禁用这个用户吗？其现有登录状态也将失效。',
            'reject_confirm' => '确定拒绝这条 DNS 申请吗？',
            'csrf_error' => '页面已过期，请返回刷新后重试。',
            'not_found_title' => '页面不存在',
            'not_found_text' => '你访问的页面不存在或已经移动。',
            'forbidden_title' => '没有访问权限',
            'forbidden_text' => '当前账号不能访问这个管理页面。',
            'return_home' => '返回首页',
            'method_not_allowed' => '请求方法不被允许。',
            'registered_admin' => '首个管理员账号创建成功。请先添加可供申请的域名后缀。',
            'registered_user' => '注册成功，现在可以提交 DNS 申请。',
            'login_success' => '欢迎回来。',
            'logout_success' => '已安全退出登录。',
            'locale_updated' => '界面语言已切换。',
            'user_status_updated' => '用户状态已更新。',
            'domain_created' => '域名后缀已添加。',
            'domain_status_updated' => '域名状态已更新。',
            'request_created' => 'DNS 申请已提交，请等待管理员审核。',
            'review_approved' => '申请已通过，请到 Cloudflare 手动添加解析。',
            'review_rejected' => '申请已拒绝。',
            'request_resolved' => '已确认人工解析完成。',
            'username_invalid' => '用户名格式不正确，请按提示使用 3–32 位字符。',
            'password_invalid' => '密码长度需为 8–128 位。',
            'password_mismatch' => '两次输入的密码不一致。',
            'username_taken' => '这个用户名已经被注册。',
            'login_invalid' => '用户名或密码不正确。',
            'account_disabled' => '账号不可用，请联系管理员。',
            'user_status_invalid' => '无效的用户状态。',
            'admin_locked' => '管理员账号不能在此禁用。',
            'user_not_found' => '用户不存在。',
            'domain_invalid' => '请输入有效的域名后缀，例如 likeweixue.com。',
            'domain_exists' => '这个域名后缀已经存在。',
            'domain_not_available' => '所选域名不存在或已停止申请。',
            'domain_status_invalid' => '无效的域名状态。',
            'domain_not_found' => '域名后缀不存在。',
            'hostname_invalid' => '二级域名格式不正确，只允许单个 DNS 标签。',
            'record_type_invalid' => '不支持的 DNS 记录类型。',
            'ipv4_invalid' => 'A 记录需要有效的 IPv4 地址。',
            'ipv6_invalid' => 'AAAA 记录需要有效的 IPv6 地址。',
            'cname_invalid' => 'CNAME 记录需要有效的目标域名。',
            'cname_self' => 'CNAME 不能指向申请域名自身。',
            'txt_invalid' => 'TXT 记录需为 1–255 字节的单行有效文本。',
            'purpose_invalid' => '文字说明需为有效 UTF-8 文本，最多 500 字。',
            'hostname_taken' => '这个完整域名已有待审核或已通过的申请。',
            'review_action_invalid' => '无效的审核操作。',
            'request_already_reviewed' => '这条申请已经被审核，请刷新查看。',
            'request_not_found' => 'DNS 申请不存在。',
            'request_not_resolvable' => '只有已通过且待解析的申请才能标记为已解析。',
        ],
        'en' => [
            'app_tagline' => 'DNS requests & manual resolution',
            'nav_workspace' => 'Workspace',
            'nav_my_requests' => 'My requests',
            'nav_new_request' => 'New request',
            'nav_admin' => 'Administration',
            'nav_dns_requests' => 'DNS requests',
            'nav_domains' => 'Domains',
            'nav_users' => 'Users',
            'manual_mode' => 'Manual resolution mode',
            'manual_mode_text' => 'Once approved, an administrator adds the record manually in Cloudflare.',
            'language' => 'Language',
            'switch_language' => 'Switch',
            'logout' => 'Log out',
            'admin' => 'Admin',
            'user' => 'User',
            'menu' => 'Open navigation',
            'close_menu' => 'Close navigation',
            'login_title' => 'Log in',
            'login_subtitle' => 'Track your DNS requests or review pending submissions.',
            'register_title' => 'Create account',
            'register_subtitle' => 'Submit your first subdomain resolution request.',
            'username' => 'Username',
            'username_hint' => '3–32 letters, numbers, dots, underscores or hyphens; start with a letter, number or underscore.',
            'password' => 'Password',
            'password_confirm' => 'Confirm password',
            'password_hint' => 'Between 8 and 128 characters.',
            'login' => 'Log in',
            'register' => 'Register',
            'no_account' => 'No account yet?',
            'have_account' => 'Already have an account?',
            'first_admin_notice' => 'The first successfully registered user becomes the administrator. Register it first and keep it secure.',
            'welcome_eyebrow' => 'DNS REQUEST WORKSPACE',
            'auth_hero_title' => 'Share your domains. Keep every DNS change under control.',
            'auth_hero_text' => 'A lightweight DNS notebook for collecting subdomain requests, reviewing them, and personally confirming every manual DNS change.',
            'auth_step_1_title' => 'Submit a DNS wish',
            'auth_step_1_text' => 'Choose a suffix and provide a record and its purpose.',
            'auth_step_2_title' => 'Administrator review',
            'auth_step_2_text' => 'Records and purposes stay visible for informed decisions.',
            'auth_step_3_title' => 'Confirm manually',
            'auth_step_3_text' => 'Review and Cloudflare completion are tracked separately.',
            'dashboard_title' => 'My requests',
            'dashboard_greeting' => 'Hello, :name',
            'dashboard_subtitle' => 'Track your DNS requests, review decisions, and manual resolution progress.',
            'total_requests' => 'Total requests',
            'pending_review' => 'Pending review',
            'waiting_resolution' => 'Awaiting resolution',
            'resolved' => 'Resolved',
            'new_request' => 'New DNS request',
            'requests_empty' => 'No DNS requests yet',
            'requests_empty_text' => 'Choose a domain suffix and submit your first DNS record.',
            'create_first_request' => 'Create your first request',
            'col_domain' => 'Full domain',
            'col_record' => 'DNS record',
            'col_purpose' => 'Purpose',
            'col_review' => 'Review',
            'col_resolution' => 'Resolution',
            'col_created' => 'Submitted',
            'col_user' => 'Requested by',
            'col_status' => 'Status',
            'col_actions' => 'Actions',
            'col_role' => 'Role',
            'col_username' => 'Username',
            'not_applicable' => '—',
            'status_pending' => 'Pending',
            'status_approved' => 'Approved',
            'status_rejected' => 'Rejected',
            'resolution_pending' => 'Awaiting resolution',
            'resolution_resolved' => 'Resolved',
            'review_note' => 'Review note',
            'new_request_title' => 'New DNS request',
            'new_request_subtitle' => 'Request one subdomain and DNS record, then wait for administrator review.',
            'manual_notice_title' => 'This panel does not change DNS automatically',
            'manual_notice_text' => 'After approval, an administrator adds the record in Cloudflare and then marks it resolved here.',
            'domain_suffix' => 'Domain suffix',
            'select_domain' => 'Select a domain',
            'hostname' => 'Subdomain',
            'hostname_hint' => 'Enter one label such as beta, not a full domain. Letters, numbers and internal hyphens are allowed.',
            'record_type' => 'Record type',
            'record_value' => 'Record value',
            'purpose' => 'Purpose',
            'purpose_hint' => 'Describe the project or website to help the administrator review it. Up to 500 characters.',
            'submit_request' => 'Submit request',
            'record_hint_A' => 'Enter an IPv4 address, for example 192.0.2.10.',
            'record_hint_AAAA' => 'Enter an IPv6 address, for example 2001:db8::10.',
            'record_hint_CNAME' => 'Enter a target domain such as example.com, not a URL.',
            'record_hint_TXT' => 'Enter one line of TXT content, up to 255 bytes.',
            'no_domains_title' => 'No domains available',
            'no_domains_text' => 'Ask an administrator to add or enable a domain suffix before submitting.',
            'manage_domains' => 'Manage domains',
            'back_dashboard' => 'Back to my requests',
            'users_title' => 'User management',
            'users_subtitle' => 'View registered users and control whether regular users can access the panel.',
            'status_active' => 'Active',
            'status_disabled' => 'Disabled',
            'disable' => 'Disable',
            'enable' => 'Enable',
            'no_users' => 'No users yet.',
            'domains_title' => 'Domain management',
            'domains_subtitle' => 'Configure suffixes users can request. Disabling a suffix does not change existing requests.',
            'add_domain' => 'Add domain',
            'domain_placeholder' => 'For example, likeweixue.com',
            'domain_enabled' => 'Enabled',
            'domain_disabled' => 'Disabled',
            'no_domains' => 'No domain suffixes yet.',
            'dns_requests_title' => 'DNS request management',
            'dns_requests_subtitle' => 'Review requests and confirm resolution after completing the manual Cloudflare change.',
            'filter_all' => 'All',
            'filter_pending' => 'Pending review',
            'filter_approved' => 'Awaiting resolution',
            'filter_resolved' => 'Resolved',
            'filter_rejected' => 'Rejected',
            'review' => 'Review',
            'approve' => 'Approve',
            'reject' => 'Reject',
            'review_note_placeholder' => 'Optional review note',
            'mark_resolved' => 'Mark resolved',
            'no_requests' => 'No DNS requests yet.',
            'no_requests_filter' => 'No requests match this filter.',
            'cloudflare_reminder' => 'Approving does not change Cloudflare. After adding the record manually, return and select “Mark resolved”.',
            'resolved_at' => 'Resolved at',
            'reviewed_at' => 'Reviewed at',
            'resolve_confirm' => 'Confirm that you have manually added this record in Cloudflare.',
            'disable_confirm' => 'Disable this user? Their existing session will also stop working.',
            'reject_confirm' => 'Reject this DNS request?',
            'csrf_error' => 'This page has expired. Go back, refresh, and try again.',
            'not_found_title' => 'Page not found',
            'not_found_text' => 'The page you requested does not exist or has moved.',
            'forbidden_title' => 'Access denied',
            'forbidden_text' => 'This account cannot access the administration page.',
            'return_home' => 'Return home',
            'method_not_allowed' => 'Request method not allowed.',
            'registered_admin' => 'The first administrator account is ready. Add a domain suffix to accept requests.',
            'registered_user' => 'Registration complete. You can now submit DNS requests.',
            'login_success' => 'Welcome back.',
            'logout_success' => 'You have been logged out.',
            'locale_updated' => 'Language updated.',
            'user_status_updated' => 'User status updated.',
            'domain_created' => 'Domain suffix added.',
            'domain_status_updated' => 'Domain status updated.',
            'request_created' => 'DNS request submitted. Please wait for administrator review.',
            'review_approved' => 'Request approved. Add the record manually in Cloudflare.',
            'review_rejected' => 'Request rejected.',
            'request_resolved' => 'Manual resolution confirmed.',
            'username_invalid' => 'Invalid username. Follow the 3–32 character format shown below.',
            'password_invalid' => 'Password must be between 8 and 128 characters.',
            'password_mismatch' => 'The password confirmation does not match.',
            'username_taken' => 'This username is already registered.',
            'login_invalid' => 'Incorrect username or password.',
            'account_disabled' => 'This account is unavailable. Contact the administrator.',
            'user_status_invalid' => 'Invalid user status.',
            'admin_locked' => 'The administrator account cannot be disabled here.',
            'user_not_found' => 'User not found.',
            'domain_invalid' => 'Enter a valid suffix such as likeweixue.com.',
            'domain_exists' => 'This domain suffix already exists.',
            'domain_not_available' => 'The selected domain is missing or unavailable.',
            'domain_status_invalid' => 'Invalid domain status.',
            'domain_not_found' => 'Domain suffix not found.',
            'hostname_invalid' => 'Invalid subdomain. Use one valid DNS label.',
            'record_type_invalid' => 'Unsupported DNS record type.',
            'ipv4_invalid' => 'An A record requires a valid IPv4 address.',
            'ipv6_invalid' => 'An AAAA record requires a valid IPv6 address.',
            'cname_invalid' => 'A CNAME record requires a valid target domain.',
            'cname_self' => 'A CNAME cannot point to the requested domain itself.',
            'txt_invalid' => 'TXT content must be valid single-line text between 1 and 255 bytes.',
            'purpose_invalid' => 'Text must be valid UTF-8 and no more than 500 characters.',
            'hostname_taken' => 'This full domain already has a pending or approved request.',
            'review_action_invalid' => 'Invalid review action.',
            'request_already_reviewed' => 'This request was already reviewed. Refresh to see its status.',
            'request_not_found' => 'DNS request not found.',
            'request_not_resolvable' => 'Only approved requests awaiting resolution can be marked resolved.',
        ],
    ];

    $locale = currentLocale();
    $text = $translations[$locale][$key] ?? $translations['zh-CN'][$key] ?? $key;
    foreach ($replace as $name => $value) {
        $text = str_replace(':' . $name, (string) $value, $text);
    }
    return $text;
}

function formatDate(?string $date): string
{
    if ($date === null || $date === '') {
        return '—';
    }
    $timestamp = strtotime($date);
    return $timestamp === false ? '—' : gmdate('Y-m-d H:i', $timestamp) . ' UTC';
}

function navClass(string $active, string $key): string
{
    return $active === $key ? 'nav-link active' : 'nav-link';
}

function localeForm(): void
{
    ?>
    <form method="post" action="/locale" class="locale-form">
        <input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>">
        <input type="hidden" name="return_to" value="<?= e($_SERVER['REQUEST_URI'] ?? '/') ?>">
        <select name="locale" class="locale-select" aria-label="<?= e(t('language')) ?>">
            <option value="zh-CN" <?= currentLocale() === 'zh-CN' ? 'selected' : '' ?>>简体中文</option>
            <option value="en" <?= currentLocale() === 'en' ? 'selected' : '' ?>>English</option>
        </select>
        <button type="submit" class="btn btn-quiet btn-small locale-submit"><?= e(t('switch_language')) ?></button>
    </form>
    <?php
}

function brand(): void
{
    ?>
    <a href="/" class="brand" aria-label="dnspanel">
        <span class="brand-mark"><span>D</span></span>
        <span class="brand-name">dnspanel</span>
        <span class="brand-beta">BETA</span>
    </a>
    <?php
}

function renderPage(string $titleKey, ?array $user, string $active, callable $content): void
{
    $flash = pullFlash();
    $locale = currentLocale();
    ?><!DOCTYPE html>
<html lang="<?= e($locale) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <title><?= e(t($titleKey)) ?> · dnspanel</title>
    <link rel="stylesheet" href="/assets/app.css">
</head>
<body class="<?= $user === null ? 'auth-body' : 'app-body' ?>">
<?php if ($user === null): ?>
    <header class="public-header">
        <?php brand(); ?>
        <?php localeForm(); ?>
    </header>
    <?php if ($flash !== null): ?>
        <div class="public-flash alert alert-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
    <?php endif; ?>
    <?php $content(); ?>
    <footer class="public-footer">dnspanel <span>·</span> <?= e(t('app_tagline')) ?></footer>
<?php else: ?>
    <div class="app-shell">
        <aside class="sidebar" id="app-sidebar">
            <div class="sidebar-brand"><?php brand(); ?><span class="sidebar-tagline"><?= e(t('app_tagline')) ?></span></div>
            <nav class="sidebar-nav" aria-label="dnspanel">
                <div class="nav-section">
                    <p class="nav-label"><?= e(t('nav_workspace')) ?></p>
                    <a class="<?= e(navClass($active, 'dashboard')) ?>" href="/dashboard"><span class="nav-dot"></span><?= e(t('nav_my_requests')) ?></a>
                    <a class="<?= e(navClass($active, 'new-request')) ?>" href="/requests/new"><span class="nav-dot"></span><?= e(t('nav_new_request')) ?></a>
                </div>
                <?php if ($user['role'] === 'admin'): ?>
                    <div class="nav-section">
                        <p class="nav-label"><?= e(t('nav_admin')) ?></p>
                        <a class="<?= e(navClass($active, 'admin-requests')) ?>" href="/admin/requests"><span class="nav-dot"></span><?= e(t('nav_dns_requests')) ?></a>
                        <a class="<?= e(navClass($active, 'admin-domains')) ?>" href="/admin/domains"><span class="nav-dot"></span><?= e(t('nav_domains')) ?></a>
                        <a class="<?= e(navClass($active, 'admin-users')) ?>" href="/admin/users"><span class="nav-dot"></span><?= e(t('nav_users')) ?></a>
                    </div>
                <?php endif; ?>
            </nav>
            <div class="sidebar-note">
                <span class="status-dot"></span>
                <strong><?= e(t('manual_mode')) ?></strong>
                <p><?= e(t('manual_mode_text')) ?></p>
            </div>
        </aside>
        <button type="button" class="sidebar-overlay" data-sidebar-close aria-label="<?= e(t('close_menu')) ?>"></button>
        <div class="app-main">
            <header class="topbar">
                <div class="topbar-left">
                    <button type="button" class="menu-button" data-sidebar-open aria-label="<?= e(t('menu')) ?>" aria-controls="app-sidebar"><span></span><span></span><span></span></button>
                    <span class="topbar-title"><?= e(t($titleKey)) ?></span>
                </div>
                <div class="topbar-actions">
                    <?php localeForm(); ?>
                    <div class="user-chip"><span class="avatar"><?= e(strtoupper(substr($user['username'], 0, 1))) ?></span><span class="user-chip-text"><strong><?= e($user['username']) ?></strong><small><?= e(t($user['role'])) ?></small></span></div>
                    <form method="post" action="/logout">
                        <input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>">
                        <button type="submit" class="btn btn-quiet btn-small"><?= e(t('logout')) ?></button>
                    </form>
                </div>
            </header>
            <main class="content">
                <?php if ($flash !== null): ?>
                    <div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
                <?php endif; ?>
                <?php $content(); ?>
            </main>
            <footer class="app-footer">dnspanel <span>·</span> <?= e(t('app_tagline')) ?></footer>
        </div>
    </div>
<?php endif; ?>
<script src="/assets/app.js" defer></script>
</body>
</html><?php
}

function authIntro(): void
{
    ?>
    <section class="auth-intro">
        <div class="auth-intro-content">
            <span class="eyebrow"><?= e(t('welcome_eyebrow')) ?></span>
            <h1><?= e(t('auth_hero_title')) ?></h1>
            <p class="auth-lead"><?= e(t('auth_hero_text')) ?></p>
            <div class="auth-steps">
                <?php for ($step = 1; $step <= 3; $step++): ?>
                    <div class="auth-step"><span class="step-number">0<?= $step ?></span><div><h2><?= e(t('auth_step_' . $step . '_title')) ?></h2><p><?= e(t('auth_step_' . $step . '_text')) ?></p></div></div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="auth-preview" aria-hidden="true">
            <div class="preview-top"><span></span><span></span><span></span></div>
            <div class="preview-domain">beta.likeweixue.com</div>
            <div class="preview-record"><span>A</span><code>192.0.2.10</code><span class="badge badge-approved"><?= e(t('status_approved')) ?></span></div>
            <div class="preview-line"></div>
            <div class="preview-line short"></div>
        </div>
    </section>
    <?php
}

function renderAuthPage(string $mode, array $old = [], ?string $error = null): void
{
    $isLogin = $mode === 'login';
    renderPage($isLogin ? 'login_title' : 'register_title', null, '', static function () use ($isLogin, $old, $error): void {
        ?>
        <main class="auth-layout">
            <?php authIntro(); ?>
            <section class="auth-card-wrap">
                <div class="auth-card">
                    <span class="auth-card-kicker"><?= $isLogin ? 'WELCOME BACK' : 'GET STARTED' ?></span>
                    <h2><?= e(t($isLogin ? 'login_title' : 'register_title')) ?></h2>
                    <p class="auth-subtitle"><?= e(t($isLogin ? 'login_subtitle' : 'register_subtitle')) ?></p>
                    <?php if ($error !== null): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
                    <?php if (!$isLogin): ?><div class="notice notice-neutral"><?= e(t('first_admin_notice')) ?></div><?php endif; ?>
                    <form method="post" action="/<?= $isLogin ? 'login' : 'register' ?>" class="stack-form">
                        <input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>">
                        <div class="form-group">
                            <label for="username"><?= e(t('username')) ?></label>
                            <input id="username" name="username" type="text" value="<?= e($old['username'] ?? '') ?>" required minlength="3" maxlength="32" pattern="[A-Za-z0-9_][A-Za-z0-9_.\-]{2,31}" autocomplete="username" autofocus>
                            <?php if (!$isLogin): ?><p class="form-hint"><?= e(t('username_hint')) ?></p><?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="password"><?= e(t('password')) ?></label>
                            <input id="password" name="password" type="password" required minlength="8" maxlength="128" autocomplete="<?= $isLogin ? 'current-password' : 'new-password' ?>">
                            <?php if (!$isLogin): ?><p class="form-hint"><?= e(t('password_hint')) ?></p><?php endif; ?>
                        </div>
                        <?php if (!$isLogin): ?>
                            <div class="form-group">
                                <label for="password_confirmation"><?= e(t('password_confirm')) ?></label>
                                <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" maxlength="128" autocomplete="new-password">
                            </div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary btn-block"><?= e(t($isLogin ? 'login' : 'register')) ?></button>
                    </form>
                    <p class="auth-switch"><?= e(t($isLogin ? 'no_account' : 'have_account')) ?> <a href="/<?= $isLogin ? 'register' : 'login' ?>"><?= e(t($isLogin ? 'register' : 'login')) ?></a></p>
                </div>
            </section>
        </main>
        <?php
    });
}

function reviewBadge(string $status): void
{
    $labels = ['pending' => 'status_pending', 'approved' => 'status_approved', 'rejected' => 'status_rejected'];
    $key = $labels[$status] ?? 'status_pending';
    ?><span class="badge badge-<?= e($status) ?>"><span></span><?= e(t($key)) ?></span><?php
}

function resolutionBadge(?string $status): void
{
    if ($status === null) {
        ?><span class="muted">—</span><?php return;
    }
    $key = $status === 'resolved' ? 'resolution_resolved' : 'resolution_pending';
    ?><span class="badge badge-<?= e($status) ?>"><span></span><?= e(t($key)) ?></span><?php
}

function pageHeader(string $title, string $subtitle, ?string $actionPath = null, ?string $actionLabel = null): void
{
    ?>
    <div class="page-header">
        <div><h1><?= e($title) ?></h1><p><?= e($subtitle) ?></p></div>
        <?php if ($actionPath !== null): ?><a href="<?= e($actionPath) ?>" class="btn btn-primary"><?= e($actionLabel) ?></a><?php endif; ?>
    </div>
    <?php
}

function renderDashboard(array $user, array $requests): void
{
    renderPage('dashboard_title', $user, 'dashboard', static function () use ($user, $requests): void {
        $pending = count(array_filter($requests, static fn (array $request): bool => $request['review_status'] === 'pending'));
        $waiting = count(array_filter($requests, static fn (array $request): bool => $request['review_status'] === 'approved' && $request['resolution_status'] === 'pending'));
        $resolved = count(array_filter($requests, static fn (array $request): bool => $request['resolution_status'] === 'resolved'));

        pageHeader(t('dashboard_greeting', ['name' => $user['username']]), t('dashboard_subtitle'), '/requests/new', t('new_request'));
        ?>
        <section class="stats-grid">
            <div class="stat-card"><span class="stat-icon blue"></span><div><p><?= e(t('total_requests')) ?></p><strong><?= count($requests) ?></strong></div></div>
            <div class="stat-card"><span class="stat-icon amber"></span><div><p><?= e(t('pending_review')) ?></p><strong><?= $pending ?></strong></div></div>
            <div class="stat-card"><span class="stat-icon violet"></span><div><p><?= e(t('waiting_resolution')) ?></p><strong><?= $waiting ?></strong></div></div>
            <div class="stat-card"><span class="stat-icon green"></span><div><p><?= e(t('resolved')) ?></p><strong><?= $resolved ?></strong></div></div>
        </section>
        <section class="card table-card">
            <div class="card-header"><div><h2><?= e(t('nav_my_requests')) ?></h2><p><?= e(t('app_tagline')) ?></p></div></div>
            <?php if ($requests === []): ?>
                <div class="empty-state"><div class="empty-symbol">DNS</div><h3><?= e(t('requests_empty')) ?></h3><p><?= e(t('requests_empty_text')) ?></p><a href="/requests/new" class="btn btn-primary"><?= e(t('create_first_request')) ?></a></div>
            <?php else: ?>
                <div class="table-wrap"><table><thead><tr><th><?= e(t('col_domain')) ?></th><th><?= e(t('col_record')) ?></th><th><?= e(t('col_purpose')) ?></th><th><?= e(t('col_review')) ?></th><th><?= e(t('col_resolution')) ?></th><th><?= e(t('col_created')) ?></th></tr></thead><tbody>
                <?php foreach ($requests as $request): ?>
                    <tr>
                        <td><strong class="domain-name"><?= e($request['fqdn']) ?></strong></td>
                        <td><div class="record-cell"><span class="record-type"><?= e($request['record_type']) ?></span><code><?= e($request['record_value']) ?></code></div></td>
                        <td><div class="purpose-text"><?= e($request['purpose']) ?></div><?php if ($request['review_note'] !== ''): ?><small class="review-note"><?= e(t('review_note')) ?>: <?= e($request['review_note']) ?></small><?php endif; ?></td>
                        <td><?php reviewBadge($request['review_status']); ?></td>
                        <td><?php resolutionBadge($request['resolution_status']); ?></td>
                        <td><span class="date-text"><?= e(formatDate($request['created_at'])) ?></span></td>
                    </tr>
                <?php endforeach; ?>
                </tbody></table></div>
            <?php endif; ?>
        </section>
        <?php
    });
}

function renderNewRequest(array $user, array $domains, array $old = [], ?string $error = null): void
{
    renderPage('new_request_title', $user, 'new-request', static function () use ($user, $domains, $old, $error): void {
        pageHeader(t('new_request_title'), t('new_request_subtitle'));
        ?>
        <div class="notice notice-info notice-page"><strong><?= e(t('manual_notice_title')) ?></strong><p><?= e(t('manual_notice_text')) ?></p></div>
        <?php if ($error !== null): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
        <?php if ($domains === []): ?>
            <section class="card empty-state"><div class="empty-symbol">DNS</div><h3><?= e(t('no_domains_title')) ?></h3><p><?= e(t('no_domains_text')) ?></p><?php if ($user['role'] === 'admin'): ?><a href="/admin/domains" class="btn btn-primary"><?= e(t('manage_domains')) ?></a><?php else: ?><a href="/dashboard" class="btn btn-secondary"><?= e(t('back_dashboard')) ?></a><?php endif; ?></section>
        <?php else: ?>
            <?php
            $selectedDomain = $domains[0];
            foreach ($domains as $domain) {
                if (($old['domain_id'] ?? '') === $domain['id']) {
                    $selectedDomain = $domain;
                }
            }
            $selectedType = $old['record_type'] ?? 'A';
            if (!in_array($selectedType, ['A', 'AAAA', 'CNAME', 'TXT'], true)) {
                $selectedType = 'A';
            }
            $previewHost = ($old['hostname'] ?? '') !== '' ? $old['hostname'] : 'beta';
            ?>
            <form method="post" action="/requests" class="card form-card">
                <input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>">
                <div class="form-section"><div class="form-section-heading"><span>1</span><div><h2><?= e(t('hostname')) ?></h2><p><?= e(t('hostname_hint')) ?></p></div></div>
                    <div class="form-grid two-columns">
                        <div class="form-group"><label for="domain_id"><?= e(t('domain_suffix')) ?></label><select id="domain_id" name="domain_id" required data-domain-select>
                            <?php foreach ($domains as $domain): ?><option value="<?= e($domain['id']) ?>" data-suffix="<?= e($domain['suffix']) ?>" <?= $selectedDomain['id'] === $domain['id'] ? 'selected' : '' ?>><?= e($domain['suffix']) ?><?= $domain['enabled'] ? '' : ' (' . e(t('domain_disabled')) . ')' ?></option><?php endforeach; ?>
                        </select></div>
                        <div class="form-group"><label for="hostname"><?= e(t('hostname')) ?></label><input id="hostname" name="hostname" type="text" value="<?= e($old['hostname'] ?? '') ?>" required maxlength="63" pattern="[A-Za-z0-9](?:[A-Za-z0-9\-]{0,61}[A-Za-z0-9])?" placeholder="beta" autocomplete="off" data-hostname-input></div>
                    </div>
                    <div class="hostname-preview"><span class="status-dot"></span><strong data-hostname-preview><?= e(strtolower($previewHost . '.' . $selectedDomain['suffix'])) ?></strong></div>
                </div>
                <div class="form-section"><div class="form-section-heading"><span>2</span><div><h2><?= e(t('col_record')) ?></h2><p><?= e(t('record_hint_' . $selectedType)) ?></p></div></div>
                    <div class="form-grid record-grid">
                        <div class="form-group"><label for="record_type"><?= e(t('record_type')) ?></label><select id="record_type" name="record_type" required data-record-type><?php foreach (['A', 'AAAA', 'CNAME', 'TXT'] as $type): ?><option value="<?= $type ?>" data-hint="<?= e(t('record_hint_' . $type)) ?>" <?= $selectedType === $type ? 'selected' : '' ?>><?= $type ?></option><?php endforeach; ?></select></div>
                        <div class="form-group"><label for="record_value"><?= e(t('record_value')) ?></label><input id="record_value" name="record_value" type="text" value="<?= e($old['record_value'] ?? '') ?>" required maxlength="255" placeholder="192.0.2.10" autocomplete="off"><p class="form-hint" data-record-hint><?= e(t('record_hint_' . $selectedType)) ?></p></div>
                    </div>
                </div>
                <div class="form-section"><div class="form-section-heading"><span>3</span><div><h2><?= e(t('purpose')) ?></h2><p><?= e(t('purpose_hint')) ?></p></div></div><div class="form-group"><label class="sr-only" for="purpose"><?= e(t('purpose')) ?></label><textarea id="purpose" name="purpose" required maxlength="500" rows="5" placeholder="<?= e(t('purpose_hint')) ?>"><?= e($old['purpose'] ?? '') ?></textarea></div></div>
                <div class="form-actions"><a href="/dashboard" class="btn btn-quiet"><?= e(t('back_dashboard')) ?></a><button type="submit" class="btn btn-primary"><?= e(t('submit_request')) ?></button></div>
            </form>
        <?php endif; ?>
        <?php
    });
}

function renderAdminUsers(array $admin, array $users): void
{
    renderPage('users_title', $admin, 'admin-users', static function () use ($users): void {
        pageHeader(t('users_title'), t('users_subtitle'));
        ?>
        <section class="card table-card"><div class="table-wrap"><table><thead><tr><th><?= e(t('col_username')) ?></th><th><?= e(t('col_role')) ?></th><th><?= e(t('col_status')) ?></th><th><?= e(t('col_created')) ?></th><th class="align-right"><?= e(t('col_actions')) ?></th></tr></thead><tbody>
        <?php if ($users === []): ?><tr><td colspan="5" class="table-empty"><?= e(t('no_users')) ?></td></tr><?php endif; ?>
        <?php foreach ($users as $listedUser): ?>
            <tr><td><div class="table-user"><span class="avatar"><?= e(strtoupper(substr($listedUser['username'], 0, 1))) ?></span><strong><?= e($listedUser['username']) ?></strong></div></td><td><span class="role-label"><?= e(t($listedUser['role'])) ?></span></td><td><?php if ($listedUser['status'] === 'active'): ?><span class="badge badge-resolved"><span></span><?= e(t('status_active')) ?></span><?php else: ?><span class="badge badge-rejected"><span></span><?= e(t('status_disabled')) ?></span><?php endif; ?></td><td><span class="date-text"><?= e(formatDate($listedUser['created_at'])) ?></span></td><td class="align-right"><?php if ($listedUser['role'] !== 'admin'): ?><form method="post" action="/admin/users/status" <?= $listedUser['status'] === 'active' ? 'data-confirm="' . e(t('disable_confirm')) . '"' : '' ?>><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><input type="hidden" name="user_id" value="<?= e($listedUser['id']) ?>"><input type="hidden" name="status" value="<?= $listedUser['status'] === 'active' ? 'disabled' : 'active' ?>"><button type="submit" class="btn btn-small <?= $listedUser['status'] === 'active' ? 'btn-danger-quiet' : 'btn-secondary' ?>"><?= e(t($listedUser['status'] === 'active' ? 'disable' : 'enable')) ?></button></form><?php else: ?><span class="muted">—</span><?php endif; ?></td></tr>
        <?php endforeach; ?>
        </tbody></table></div></section>
        <?php
    });
}

function renderAdminDomains(array $admin, array $domains, array $old = [], ?string $error = null): void
{
    renderPage('domains_title', $admin, 'admin-domains', static function () use ($domains, $old, $error): void {
        pageHeader(t('domains_title'), t('domains_subtitle'));
        if ($error !== null) { echo '<div class="alert alert-error">' . e($error) . '</div>'; }
        ?>
        <section class="card compact-card"><form method="post" action="/admin/domains/create" class="inline-form"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><div class="form-group"><label for="suffix"><?= e(t('add_domain')) ?></label><input id="suffix" name="suffix" type="text" required maxlength="253" placeholder="<?= e(t('domain_placeholder')) ?>" value="<?= e($old['suffix'] ?? '') ?>"></div><button type="submit" class="btn btn-primary"><?= e(t('add_domain')) ?></button></form></section>
        <section class="card table-card"><div class="table-wrap"><table><thead><tr><th><?= e(t('domain_suffix')) ?></th><th><?= e(t('col_status')) ?></th><th><?= e(t('col_created')) ?></th><th class="align-right"><?= e(t('col_actions')) ?></th></tr></thead><tbody>
        <?php if ($domains === []): ?><tr><td colspan="4" class="table-empty"><?= e(t('no_domains')) ?></td></tr><?php endif; ?>
        <?php foreach ($domains as $domain): ?>
            <tr><td><strong class="domain-name"><?= e($domain['suffix']) ?></strong></td><td><?php if ($domain['enabled']): ?><span class="badge badge-resolved"><span></span><?= e(t('domain_enabled')) ?></span><?php else: ?><span class="badge badge-neutral"><span></span><?= e(t('domain_disabled')) ?></span><?php endif; ?></td><td><span class="date-text"><?= e(formatDate($domain['created_at'])) ?></span></td><td class="align-right"><form method="post" action="/admin/domains/status"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><input type="hidden" name="domain_id" value="<?= e($domain['id']) ?>"><input type="hidden" name="status" value="<?= $domain['enabled'] ? 'disabled' : 'enabled' ?>"><button type="submit" class="btn btn-small btn-secondary"><?= e(t($domain['enabled'] ? 'disable' : 'enable')) ?></button></form></td></tr>
        <?php endforeach; ?>
        </tbody></table></div></section>
        <?php
    });
}

function requestMatchesFilter(array $request, string $filter): bool
{
    return match ($filter) {
        'pending' => $request['review_status'] === 'pending',
        'approved' => $request['review_status'] === 'approved' && $request['resolution_status'] === 'pending',
        'resolved' => $request['resolution_status'] === 'resolved',
        'rejected' => $request['review_status'] === 'rejected',
        default => true,
    };
}

function renderAdminRequests(array $admin, array $requests, string $filter): void
{
    renderPage('dns_requests_title', $admin, 'admin-requests', static function () use ($requests, $filter): void {
        $counts = [];
        foreach (['all', 'pending', 'approved', 'resolved', 'rejected'] as $name) {
            $counts[$name] = count(array_filter($requests, static fn (array $request): bool => requestMatchesFilter($request, $name)));
        }
        $filtered = array_values(array_filter($requests, static fn (array $request): bool => requestMatchesFilter($request, $filter)));

        pageHeader(t('dns_requests_title'), t('dns_requests_subtitle'));
        ?>
        <div class="notice notice-info notice-page"><strong>Cloudflare</strong><p><?= e(t('cloudflare_reminder')) ?></p></div>
        <nav class="filter-tabs" aria-label="DNS filters"><?php foreach (['all', 'pending', 'approved', 'resolved', 'rejected'] as $name): ?><a href="/admin/requests?status=<?= $name ?>" class="<?= $filter === $name ? 'active' : '' ?>"><?= e(t('filter_' . $name)) ?><span><?= $counts[$name] ?></span></a><?php endforeach; ?></nav>
        <section class="card table-card">
            <?php if ($filtered === []): ?><div class="empty-state compact"><h3><?= e(t($requests === [] ? 'no_requests' : 'no_requests_filter')) ?></h3></div><?php else: ?>
            <div class="table-wrap"><table class="admin-request-table"><thead><tr><th><?= e(t('col_domain')) ?></th><th><?= e(t('col_user')) ?></th><th><?= e(t('col_record')) ?></th><th><?= e(t('col_purpose')) ?></th><th><?= e(t('col_status')) ?></th><th><?= e(t('col_actions')) ?></th></tr></thead><tbody>
            <?php foreach ($filtered as $request): ?>
                <tr>
                    <td><strong class="domain-name"><?= e($request['fqdn']) ?></strong><small class="date-text block"><?= e(formatDate($request['created_at'])) ?></small></td>
                    <td><span class="table-username"><?= e($request['username']) ?></span></td>
                    <td><div class="record-cell"><span class="record-type"><?= e($request['record_type']) ?></span><code><?= e($request['record_value']) ?></code></div></td>
                    <td><div class="purpose-text"><?= e($request['purpose']) ?></div><?php if ($request['review_note'] !== ''): ?><small class="review-note"><?= e(t('review_note')) ?>: <?= e($request['review_note']) ?></small><?php endif; ?></td>
                    <td><div class="status-stack"><?php reviewBadge($request['review_status']); ?><?php resolutionBadge($request['resolution_status']); ?></div><?php if ($request['reviewed_at'] !== null): ?><small class="date-text block"><?= e(t('reviewed_at')) ?>: <?= e(formatDate($request['reviewed_at'])) ?></small><?php endif; ?></td>
                    <td class="action-cell">
                        <?php if ($request['review_status'] === 'pending'): ?>
                            <details class="review-details"><summary class="btn btn-small btn-primary"><?= e(t('review')) ?></summary><form method="post" action="/admin/requests/review" class="review-form"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><input type="hidden" name="request_id" value="<?= e($request['id']) ?>"><label class="sr-only" for="note-<?= e($request['id']) ?>"><?= e(t('review_note')) ?></label><textarea id="note-<?= e($request['id']) ?>" name="review_note" rows="3" maxlength="500" placeholder="<?= e(t('review_note_placeholder')) ?>"></textarea><button type="submit" name="action" value="approve" class="btn btn-small btn-primary"><?= e(t('approve')) ?></button><button type="submit" name="action" value="reject" class="btn btn-small btn-danger-quiet" data-confirm-click="<?= e(t('reject_confirm')) ?>"><?= e(t('reject')) ?></button></form></details>
                        <?php elseif ($request['review_status'] === 'approved' && $request['resolution_status'] === 'pending'): ?>
                            <form method="post" action="/admin/requests/resolve" data-confirm="<?= e(t('resolve_confirm')) ?>"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><input type="hidden" name="request_id" value="<?= e($request['id']) ?>"><button type="submit" class="btn btn-small btn-success"><?= e(t('mark_resolved')) ?></button></form>
                        <?php elseif ($request['resolution_status'] === 'resolved'): ?>
                            <small class="date-text"><?= e(t('resolved_at')) ?><br><?= e(formatDate($request['resolved_at'])) ?></small>
                        <?php else: ?><span class="muted">—</span><?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody></table></div><?php endif; ?>
        </section>
        <?php
    });
}

function renderErrorPage(string $type, ?array $user): void
{
    $titleKey = $type === 'forbidden' ? 'forbidden_title' : 'not_found_title';
    $textKey = $type === 'forbidden' ? 'forbidden_text' : 'not_found_text';
    renderPage($titleKey, $user, '', static function () use ($titleKey, $textKey, $user): void {
        ?><main class="<?= $user === null ? 'standalone-error' : 'card empty-state' ?>"><div class="empty-symbol">404</div><h1><?= e(t($titleKey)) ?></h1><p><?= e(t($textKey)) ?></p><a href="/" class="btn btn-primary"><?= e(t('return_home')) ?></a></main><?php
    });
}
