<?php

require_once '../handlers/db.php';
require_once '../handlers/api.php';

$stmt = $pdo->prepare('SELECT * from shops where enabled = 1');
$stmt->execute();
$shops = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT * from categories');
$stmt->execute();
$categories = $stmt->fetchAll();

foreach ($shops as $key => $value) {
    $content = api_request($value['path'] . '/all/categories', 'GET', '', '');
    $shops[$key]['categories'] = $content->data;
}

$data = [
    'menu_items' => include '../data/admin-menu.php',
    'shops' => $shops,
    'categories' => $categories,
];

if (count($data['menu_items']) === 0) {
    http_response_code(403);
    die('Forbidden');
}

ob_start();

extract($data);

require '../templates/admin/admin-header.php';
require '../templates/admin/categories.php';
require '../templates/footer.php';

ob_get_contents();
