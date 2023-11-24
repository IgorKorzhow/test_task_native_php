<?php

use Kernel\Bootstrap\App;

require '../vendor/autoload.php';
ini_set('error_reporting', true);

$_ENV = array_merge($_ENV, parse_ini_file('../.env'));

(new App())->run();