<?php

$config = [
    'dbname'            => 'diplom',
    'host'              => '127.0.0.1',
    'login'             => 'homestead',
    'password'          => 'secret',
    'dboption'          => array(
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'cp1251'"
    ),
];

$pdo = new PDO("mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'] . ";charset=utf8", $config['login'], $config['password'], $config['dboption']);
$pdo->exec("set names utf8");
