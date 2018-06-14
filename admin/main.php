<?php

ob_start();

require_once '../handlers/db.php';
require_once '../handlers/api.php';

$stmt = $pdo->prepare('SELECT * FROM main_page');
$stmt->execute();
$content = $stmt->fetchAll();

$data = [
    'menu_items' => include '../data/admin-menu.php',
    'content' => array_chunk($content, 2),
];


if (count($data['menu_items']) === 0) {
    http_response_code(403);
    die('Forbidden');
}

extract($data);

require '../templates/admin/admin-header.php';
require '../templates/admin/main.php';
require '../templates/footer.php';

ob_get_contents();

