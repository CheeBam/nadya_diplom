<?php

require_once '../handlers/db.php';

$stmt = $pdo->prepare('SELECT * from feedback');
$stmt->execute();
$feedback = $stmt->fetchAll();

$feedback = array_map(function ($item) {
    $date = new DateTime($item['date']);
    $item['date'] = $date->format('d-m-Y H:i:s');
    return $item;
}, $feedback);

$data = [
    'menu_items' => include '../data/admin-menu.php',
    'feedback' => $feedback,
];

if (count($data['menu_items']) === 0) {
    http_response_code(403);
    die('Forbidden');
}

ob_start();

extract($data);

require '../templates/admin/admin-header.php';
require '../templates/admin/feedback.php';
require '../templates/footer.php';

ob_get_contents();
