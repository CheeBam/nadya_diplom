<?php

session_start();

unset($_SESSION['token']);

header("Location: http://".$_SERVER['SERVER_NAME']);
