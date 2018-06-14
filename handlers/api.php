<?php

//define('BASE_URL', 'http://diplom-api.hz/api/');

function api_request($resource, $method, $login, $password, $args=null) {

    $options = [
        CURLOPT_URL => $resource,
//        CURLOPT_USERPWD => "$login:$password",
        CURLOPT_USERPWD => '',
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json'
        ],
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => "Monitoring API Client v1.0"
    ];
    if ($args) {
        $json_args = json_encode($args);
        $options[CURLOPT_POSTFIELDS] = $json_args;
    }

    $ch = curl_init();
    curl_setopt_array($ch, $options);

    $content = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status > 399) {
        echo 'Api error. Status: ' . $status;
        die($content);
//        throw new Exception("Exception $status: $content");
    }
    return json_decode($content);
}
