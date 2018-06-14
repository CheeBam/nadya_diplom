<?php

define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . '/');

require_once ROOT . '/handlers/db.php';

session_start();

$is_logged = false;
$logged_name = 'Guest';

if (isset($_SESSION['token'])) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE token = ?');
    $stmt->execute([$_SESSION['token']]);
    $user = $stmt->fetch();

    if ($user && $user['name']) {
        $is_logged = true;
        $logged_name = $user['name'];
    }
}

if ($is_logged) {
    $data = [
        'shops' => [
            'title' => 'Магазини',
            'id' => 1,
            'link' => '/admin/shops.php'
        ],
        'cats' => [
            'title' => 'Категорії',
            'id' => 2,
            'link' => '/admin/categories.php'
        ],
        'feedback' => [
            'title' => 'Відгуки',
            'id' => 2,
            'link' => '/admin/feedback.php'
        ],
        'mail' => [
            'title' => 'На головну',
            'id' => 3,
            'link' => '/'
        ],
    ];

    $result['main'] = $data;

    $result['right'] = [
        'logged' => [
            'title' => 'Привіт, ' . ucfirst($logged_name),
            'id' => 3,
            'link' => false
        ],
        'auth' => [
            'title' => $is_logged ? 'Вихід' : 'Вхід',
            'id' => 5,
            'link' => $is_logged ? '/logout.php' : '/login.php',
        ],
    ];
    return $result;

} else {
    return [];
}





