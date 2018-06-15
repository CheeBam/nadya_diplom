<?php

require_once 'handlers/db.php';
require_once 'handlers/api.php';

$data = [
    'menu_items' => include 'data/menu.php',
];

ob_start();

extract($data);

require 'templates/header.php';
require 'templates/feedback.php';
require 'templates/footer.php';

ob_get_contents();

