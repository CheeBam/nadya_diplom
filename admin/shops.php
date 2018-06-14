<?php

require_once '../handlers/db.php';

$stmt = $pdo->prepare('SELECT * from shops');
$stmt->execute();
$shops = $stmt->fetchAll();

$data = [
    'menu_items' => include '../data/admin-menu.php',
    'shops' => $shops,
];

if (count($data['menu_items']) === 0) {
    http_response_code(403);
    die('Forbidden');
}

ob_start();

extract($data);

require '../templates/admin/admin-header.php';
require '../templates/admin/shops.php';
require '../templates/footer.php';

ob_get_contents();
