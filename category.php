<?php

require_once 'handlers/db.php';
require_once 'handlers/api.php';

$stmt = $pdo->prepare('SELECT * from categories where id = ?');
$stmt->execute([$_GET['id']]);
$category = $stmt->fetch();

$stmt = $pdo->prepare('SELECT * from shops where enabled = 1');
$stmt->execute();
$shops = $stmt->fetchAll();

$filtered_shops = [];

foreach ($shops as $key => $value) {
    $content = api_request($value['path'] . '/product/by/category?title=' . $category['title'], 'GET', '', '');

    if ($content->data) {

        foreach ($content->data as $key2 => $value2) {
            $price = 0;
            foreach($value2->purchases as $purchase) {
                $price += $purchase->price;
            }
            if ($price != 0) {
                $value2->avg_price = $price / count($value2->purchases);
            } else {
                $value2->avg_price = '-';
            }
        }

        $shops[$key]['products'] = array_chunk($content->data, 3);
        $filtered_shops[$key] = $shops[$key];
    }
}

$data = [
    'menu_items' => include 'data/menu.php',
    'shops' => $filtered_shops,
    'category' => $category,
];

ob_start();

extract($data);

require 'templates/header.php';
require 'templates/category.php';
require 'templates/footer.php';

ob_get_contents();

