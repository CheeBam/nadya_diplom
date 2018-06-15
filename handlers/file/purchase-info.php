<?php

include '../file.php';

require_once '../../handlers/db.php';
require_once '../../handlers/api.php';

$stmt = $pdo->prepare('SELECT * FROM shops where enabled = ?');
$stmt->execute([1]);
$shops = $stmt->fetchAll();

$data = [];

$result = [];
$result[] = [ strtoupper('Додаткова інформація про покупки') ];
$result[] = [];

foreach ($shops as $shop) {
    $content = api_request($shop['path'] . '/file/purchases/info', 'GET', '', '');

    $result[] = [ strtoupper($shop['title']) ];
    $max_p = ['Максимальна ціна продажу:', $content->data->max_price->price, 'Товар:', $content->data->max_price->title];
    $min_p = ['Мінімальна ціна продажу:',  $content->data->min_price->price, 'Товар:', $content->data->min_price->title];
    $max_c = ['Найбільша кількість продаж товару:', $content->data->max_count->count, 'Товар:', $content->data->max_count->title];
    $min_c = ['Найменша кількість продаж товару:', $content->data->min_count->count, 'Товар:', $content->data->min_count->title];
    $max_d = ['Найбільша кількість продаж за день:', $content->data->max_date->count, 'Дата:', $content->data->max_date->date];
    $min_d = ['Найменша кількість продаж за день:', $content->data->min_date->count, 'Дата:', $content->data->min_date->date];

    $result[] = $max_p;
    $result[] = $min_p;
    $result[] = $max_c;
    $result[] = $min_c;
    $result[] = $max_d;
    $result[] = $min_d;
    $result[] = [];
}

array_to_csv_download($result, "additional.csv");


