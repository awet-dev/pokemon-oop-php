<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'Pokemon.php';
require 'Controller.php';

$controller = new Controller();
$controller->display();


