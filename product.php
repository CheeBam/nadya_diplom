<?php

require_once 'handlers/db.php';
require_once 'handlers/api.php';

$stmt = $pdo->prepare('SELECT * FROM shops WHERE title = ?');
$stmt->execute([$_GET['shop']]);
$shop = $stmt->fetch();

$content = api_request($shop['path'] . '/product/' . $_GET['id'], 'GET', '', '');

$product = $content->data[0];
$price = 0;
$amounts = [];

foreach($product->purchases as $purchase) {
    $price += $purchase->price;
    if (array_key_exists($purchase->date, $amounts)) {
        $amounts[$purchase->date] ++;
    } else {
        $amounts[$purchase->date] = 1;
    }
}

$new_amounts = [];
foreach ($amounts as $key => $value){
    array_push($new_amounts, [
        'date' => $key,
        'count' => $value,
    ]);
}

if ($price != 0) {
    $product->avg_price = $price / count($product->purchases);
    $product->act_price = end($product->purchases)->price;
} else {
    $product->avg_price = '-';
    $product->act_price = '-';
}

$data = [
    'menu_items' => include 'data/menu.php',
    'product' => $content->data[0],
    'shop_title' => $shop['title'],
    'amounts' => $new_amounts,
];

ob_start();

extract($data);

require 'templates/header.php';
require 'templates/product.php';
require 'templates/footer.php';

ob_get_contents();

