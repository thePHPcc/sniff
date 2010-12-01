<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors',1);
define('DSN', 'mysql://root@127.0.0.1/sniff');

require __DIR__ . '/autoload.php';
session_start();

$evil = 'O:15:"sniffFileUpload":1:{s:7:"'."\0*\0".'file";s:11:"/etc/passwd";}';
unserialize($evil);
die();

$request  = new sniffRequest($_REQUEST, $_SESSION);
$response = new sniffResponse();
$factory  = new sniffFactory();

$sniff = new sniffFrontController($request, $response, $factory);
$view   = $sniff->execute(isset($_GET["controller"]) ? $_GET['controller'] : 'home');

echo $view->render($request, $response);
