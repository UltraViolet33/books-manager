<?php

session_start();
$path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

// include "../app/init.php";
require_once "../vendor/autoload.php";

use App\core\App;

$path = str_replace("index.php", "", $path);
$rootPath = str_replace("public", "", __DIR__);
// var_dump($test);
define('ROOT_PATH', $rootPath);
// var_dump(TEST);


define("ROOT", $path);
define("ASSETS", $path . "assets/");
// define("ROOT_PATH", "/BOOKS CRUD/");

$app = new App();
