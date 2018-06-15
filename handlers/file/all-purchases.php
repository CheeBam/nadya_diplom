<?php

include '../file.php';

require_once '../../handlers/db.php';
require_once '../../handlers/api.php';

$stmt = $pdo->prepare('SELECT * FROM shops where enabled = ?');
$stmt->execute([1]);
$shops = $stmt->fetchAll();

$api_params_str = '?from=' . $_GET['from'] . '&to=' . $_GET['to'];

$data = [];

$result = [];
$result[] = [ strtoupper('Кількість продаж та прибуток по кожному магазину') ];
$result[] = [];

foreach ($shops as $shop) {
    $content = api_request($shop['path'] . '/file/purchases/all' . $api_params_str, 'GET', '', '');

    $sum_price = 0;
    $sum_count = 0;
    foreach ($content->data as $item) {
        $sum_price += $item->price;
        $sum_count += $item->count;
    }

    $result[] = [ strtoupper($shop['title']) ];
    $tmp_date = [''];
    $tmp_count = ['Кількість'];
    $tmp_price = ['Прибуток'];

    foreach ($content->data as $item) {
        $time = new DateTime($item->date);
        $tmp_date[] = date_format($time, 'M y');
        $tmp_count[] = $item->count;
        $tmp_price[] = $item->price;
    }

    $tmp_date[] = 'Всього';
    $tmp_count[] = $sum_count;
    $tmp_price[] = $sum_price;

    $result[] = $tmp_date;
    $result[] = $tmp_count;
    $result[] = $tmp_price;
    $result[] = [];
}

array_to_csv_download($result, "purchases.csv");


