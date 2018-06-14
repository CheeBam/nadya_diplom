<?php

define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . '/');

require_once ROOT . '/handlers/db.php';

session_start();

$is_logged = false;
$logged_name = 'Гість';

if (isset($_SESSION['token'])) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE token = ?');
    $stmt->execute([$_SESSION['token']]);
    $user = $stmt->fetch();

    if ($user && $user['name']) {
        $is_logged = true;
        $logged_name = $user['name'];
    }
}

$stmt = $pdo->prepare('SELECT * FROM shops where enabled = ?');
$stmt->execute([1]);
$shops = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT * FROM categories where enabled = 1');
$stmt->execute();
$categories = $stmt->fetchAll();

$data = [
    'shops' => [
        'title' => 'Магазини',
        'id' => 1,
        'link' => '#',
        'sub_link' => 'shop',
        'sub' => $shops,
    ],
    'categories' => [
        'title' => 'Категорії',
        'id' => 2,
        'link' => '#',
        'sub_link' => 'category',
        'sub' => $categories,
    ],
    'report' => [
        'title' => 'Звіти',
        'id' => 3,
        'link' => '/report.php'
    ],
];

$optional = $is_logged ? [
    'admin' => [
        'title' => 'Адмін панель',
        'id' => 9,
        'link' => '/admin/main.php'
        ]
    ] : [
    'feedback' => [
        'title' => 'Залишити відгук',
        'id' => 4,
        'link' => '/feedback.php'
    ]
];

$data += $optional;

$result['main'] = $data;

$result['right'] = [
    'logged' => [
        'title' => 'Привіт, ' . ucfirst($logged_name),
        'id' => 10,
        'link' => false
    ],
    'auth' => [
        'title' => $is_logged ? 'Вихід' : 'Вхід',
        'id' => 11,
        'link' => $is_logged ? '/logout.php' : '/login.php',
    ],
];

return $result;
