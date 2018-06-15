<?php


ob_start();

require 'templates/feedback-success.php';
require 'templates/footer.php';

ob_get_contents();
