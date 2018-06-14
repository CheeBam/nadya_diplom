<?php

require_once 'handlers/db.php';
require_once 'handlers/api.php';

$stmt = $pdo->prepare('SELECT * FROM shops where enabled = 1');
$stmt->execute();
$shops = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT * FROM categories where enabled = 1');
$stmt->execute();
$categories = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT * FROM main_page where enabled = 1');
$stmt->execute();
$parts = $stmt->fetchAll();

$api_params_str = '';
if (isset($_GET['dates']) && $_GET['dates'] === 'true') {
    $api_params_str .= '/?dates=' . $_GET['dates'] . '&from=' . $_GET['from'] . '&to=' . $_GET['to'];
}

$top_products = false;
$price_categories = false;
$count_categories = false;
$count_purchases = [];
$price_purchases = [];
$count_month_purchases = [];
$price_month_purchases = [];
$count_names = false;
$price_names = false;

foreach ($parts as $part) {
    switch ($part['title']) {
        case 'top_products':
            $top_data = [];
            foreach ($shops as $shop) {
                $content = api_request($shop['path'] . '/product/by/purchases' . $api_params_str, 'GET', '', '');
                foreach ($content->data as $item) {
                    $top_data[] = $item;
                }
            }

            if (count($top_data) > 0) {
                foreach ($top_data as $key => $value) {
                    $volume[$key] = $value->amount;
                }
                array_multisort($volume, SORT_DESC, $top_data);
                $top_products = array_slice($top_data, 0, 3);

                foreach ($top_products as $key => $value) {
                    $price = 0;
                    foreach ($value->product->purchases as $purchase) {
                        $price += $purchase->price;
                    }
                    if ($price != 0) {
                        $value->avg_price = round($price / count($value->product->purchases));
                    } else {
                        $value->avg_price = '-';
                    }
                }
            }
            break;
        case 'count_purchases':
            foreach ($shops as $shop) {
                $content = api_request($shop['path'] . '/purchase/all/count' . $api_params_str, 'GET', '', '');
                $result = [
                    'name' => $shop['title'],
                    'type' => 'spline',
                    'showInLegend' => true,
                    'dataPoints' => $content->data,
                ];
                $count_purchases[] = $result;
            }
            break;
        case 'price_purchases':
            foreach ($shops as $shop) {
                $content = api_request($shop['path'] . '/purchase/all/price' . $api_params_str, 'GET', '', '');
                $result = [
                    'name' => $shop['title'],
                    'type' => 'spline',
                    'showInLegend' => true,
                    'yValueFormatString' => '#,###.## ₴',
                    'dataPoints' => $content->data,
                ];
                $price_purchases[] = $result;
            }
            break;
        case 'count_categories':
            $count_categories = true;
            break;
        case 'price_categories':
            $price_categories = true;
            break;
        case 'count_month_purchases':
            $dates = [];
            foreach ($shops as $shop) {
                $content = api_request($shop['path'] . '/purchase/all/count/month' . $api_params_str, 'GET', '', '');
                $sum = 0;
                foreach ($content->data as $item) {
                    $sum += $item->count;
                    $dates[] = $item->date;
                }
                $result = [
                    'name' => $shop['title'],
                    'data' => $content->data,
                    'sum' => $sum,
                ];
                $count_month_purchases['values'][] = $result;
            }
            $dates = array_unique($dates);
            array_multisort($dates);

            $dates_result = [];

            foreach ($dates as $date) {
                $time = new DateTime($date);
                $dates_result[] = [
                    'value' => $date,
                    'string' => date_format($time, 'M y'),
                ];
            }
            $count_month_purchases['dates'] = $dates_result;
            break;
        case 'price_month_purchases':
            $dates = [];
            foreach ($shops as $shop) {
                $content = api_request($shop['path'] . '/purchase/all/price/month' . $api_params_str, 'GET', '', '');
                $sum = 0;
                foreach ($content->data as $item) {
                    $sum += $item->price;
                    $dates[] = $item->date;
                }
                $result = [
                    'name' => $shop['title'],
                    'data' => $content->data,
                    'sum' => $sum,
                ];
                $price_month_purchases['values'][] = $result;
            }
            $dates = array_unique($dates);
            array_multisort($dates);

            $dates_result = [];

            foreach ($dates as $date) {
                $time = new DateTime($date);
                $dates_result[] = [
                    'value' => $date,
                    'string' => date_format($time, 'M y'),
                ];
            }
            $price_month_purchases['dates'] = $dates_result;
            break;
        case 'count_names':
            $count_names = true;
            break;
        case 'price_names':
            $price_names = true;
            break;
    }
}

$data = [
    'menu_items' => include 'data/menu.php',
    'categories' => $categories,
    'shops' => $shops,
    'parts' => [
        'top_products' => $top_products,
        'count_purchases' => $count_purchases,
        'price_purchases' => $price_purchases,
        'count_categories' => $count_categories,
        'price_categories' => $price_categories,
        'count_month_purchases' => $count_month_purchases,
        'price_month_purchases' => $price_month_purchases,
        'count_names' => $count_names,
        'price_names' => $price_names,
    ],
    'time_from' => isset($_GET['from']) ? $_GET['from'] : '',
    'time_to' => isset($_GET['to']) ? $_GET['to'] : '',
];

ob_start();
extract($data);

require 'templates/header.php';
require 'templates/main.php';
require 'templates/footer.php';

ob_get_contents();
