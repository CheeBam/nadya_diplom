<?php

require_once 'handlers/db.php';
require_once 'handlers/api.php';

$stmt = $pdo->prepare('SELECT * FROM shops where enabled = 1');
$stmt->execute();
$shops = $stmt->fetchAll();

$chart_data = [];
$carousel_data = [];
foreach ($shops as $shop) {
    $link = $shop['path'] . '/product/by/name/' . $_GET['name'];
    $content = api_request($shop['path'] . '/product/by/name/' . $_GET['name'], 'GET', '', '');

//    var_dump($content->data);

    if (!isset($content->data->purchases) || !isset($content->data->product)) continue;

    $chart_data[] = [
        'name' => ucfirst($shop['title']),
        'type' => 'spline',
        'showInLegend' => true,
        'dataPoints' => $content->data->purchases,
    ];

    $sum_price = 0;
    $sum_count = 0;
    $avg_price = '-';
    foreach ($content->data->purchases as $item) {
        $sum_price += $item->price;
        $sum_count += $item->cnt;
    }

    if ($sum_count > 0) {
        $avg_price = round($sum_price / $sum_count);
    }

    $carousel_data[] = [
        'shop' => ucfirst($shop['title']),
        'id' => ucfirst($content->data->product->id),
        'title' => ucfirst($content->data->product->title),
        'description' => $content->data->product->description,
        'image' => $content->data->product->image,
        'brand' => ucfirst($content->data->product->brand->title),
        'category' => ucfirst($content->data->product->category->title),
        'count_all' => $sum_count,
        'avg_price' => $avg_price,
    ];
}

$data = [
    'menu_items' => include 'data/menu.php',
    'product_name' => ucfirst($_GET['name']),
    'carousel_data' => $carousel_data,
    'chart_data' => $chart_data,
];

ob_start();

extract($data);

require 'templates/header.php';
require 'templates/product-all.php';
require 'templates/footer.php';

ob_get_contents();

