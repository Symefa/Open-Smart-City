<?php

/**
 *	Open Smart City Project.
 */
require 'libs/AltoRouter.php';
require 'libs/Points.php';
require 'libs/Main.php';

$router = new AltoRouter();
$router->setBasePath('/opensmartcity/src/');
$router->map('GET', 'listpoints', function () {
    $Points = new Points();
    echo json_encode($Points->getPoints());
    exit();
});

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    include 'html/home.html';
}
