<?php
$conf = require __DIR__.'/../conf/config.php';
$dbJob = new PDO("mysql:host={$conf['dbHost']};dbname={$conf['dbName']}", $conf['dbUser'], $conf['dbPass']);
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
echo "Username or Password is invalid";
}
?>