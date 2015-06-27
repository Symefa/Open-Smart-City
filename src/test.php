<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
echo $path;
if (strpos($path, '/help')) {
    echo 'This is some help text.';
}
