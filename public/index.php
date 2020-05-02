<?php
require_once (dirname(__DIR__) . '/app/autoload.php');

$app = new \Rest\Application();

$app->run($_SERVER["REQUEST_URI"]);

