<?php

include '../file.php';

require_once '../../handlers/db.php';
require_once '../../handlers/api.php';

$stmt = $pdo->prepare('SELECT * FROM shops where enabled = ?');
$stmt->execute([1]);
$shops = $stmt->fetchAll();

$data = [];

$result = [];
$result[] = [ strtoupper('Загальна інформація про категорії, бренди та продукти') ];
$result[] = [];

foreach ($shops as $shop) {
    $content = api_request($shop['path'] . '/file/general/all', 'GET', '', '');

    $result[] = [ strtoupper($shop['title']) ];
    $tmp_categories = ['Категорії:'];
    $tmp_brands = ['Бренди:'];
    $tmp_products = ['Продукти:'];

    foreach ($content->data->categories as $item) {
        $tmp_categories[] = $item->title;
    }
    foreach ($content->data->brands as $item) {
        $tmp_brands[] = $item->title;
    }
    foreach ($content->data->products as $item) {
        $tmp_products[] = $item->title;
    }

    $result[] = $tmp_categories;
    $result[] = $tmp_brands;
    $result[] = $tmp_products;
    $result[] = ['Всього категорій:', count($content->data->categories)];
    $result[] = ['Всього брендів:', count($content->data->brands)];
    $result[] = ['Всього продуктів:', count($content->data->products)];
    $result[] = [];
}

array_to_csv_download($result, "general.csv");


