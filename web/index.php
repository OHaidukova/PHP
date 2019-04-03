<?php

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
$loader = require( __DIR__ . '/../vendor/autoload.php');
include $_SERVER['DOCUMENT_ROOT'] . "/../base/App.php";

$config = include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";

app\base\App::call()->run($config);

//include ROOT_DIR . "services/Autoloader.php";
//$loader->addPsr4("app\\", ROOT_DIR);
//use app\services\Autoloader as Auto;
//spl_autoload_register([new Auto(), 'loadClass']);

?>