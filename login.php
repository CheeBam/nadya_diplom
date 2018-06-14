<?php

ob_start();


$data = [
    'menu_items' => include 'data/menu.php',
];

extract($data);

require 'templates/header.php';
require 'templates/login.php';
require 'templates/footer.php';

ob_get_contents();
