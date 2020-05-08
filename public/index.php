<?php
require_once(dirname(__DIR__) . '/app/autoload.php');

$app = new \Rest\Application();
$response = $app->run($_SERVER["REQUEST_URI"]);
$response->display();
