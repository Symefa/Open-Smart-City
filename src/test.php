<?php

require_once 'libs/Router.php';
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
Router::route($path, 'haha', function () {echo 'lolo';});
