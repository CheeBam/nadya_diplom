<?php

require_once 'handlers/db.php';
require_once 'handlers/api.php';

$stmt = $pdo->prepare('SELECT * FROM shops WHERE id = ?');
$stmt->execute([$_GET['id']]);
$shop = $stmt->fetch();

$content = api_request($shop['path'] . '/all/products', 'GET', '', '');

foreach($content->data as $key => $value) {
//    $value->avg_price = end($value->purchases)->price;
    $price = 0;
    foreach($value->purchases as $purchase) {
        $price += $purchase->price;
    }
    if ($price != 0) {
        $value->avg_price = $price / count($value->purchases);
    } else {
        $value->avg_price = '-';
    }
}

//var_dump($content->data);

$data = [
    'menu_items' => include 'data/menu.php',
    'shop' => $shop,
    'content' => array_chunk($content->data, 3),
];

ob_start();

extract($data);

require 'templates/header.php';
require 'templates/shop.php';
require 'templates/footer.php';

ob_get_contents();
