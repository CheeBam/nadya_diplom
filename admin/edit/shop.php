<?php

require_once '../../handlers/db.php';

$stmt = $pdo->prepare('SELECT * FROM shops WHERE id = ?');
$stmt->execute([$_GET['id']]);
$shop = $stmt->fetch();

$data = [
    'menu_items' => include '../../data/admin-menu.php',
    'shop' => $shop
];

if (count($data['menu_items']) === 0) {
    http_response_code(403);
    die('Forbidden');
}

ob_start();

extract($data);

require '../../templates/admin/admin-header.php';
require '../../templates/admin/edit/shop.php';
require '../../templates/footer.php';

ob_get_contents();
