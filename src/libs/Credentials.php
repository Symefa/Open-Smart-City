<?php

/*
 *	Open Smart City Project
 */

$conf = require __DIR__.'/../conf/config.php';

$dbJob = new PDO("mysql:host={$conf['dbHost']};dbname={$conf['dbName']}", $conf['dbUser'], $conf['dbPass']);

//start session
session_start();
if (!isset($_SESSION['username'], $_SESSION['token'])) {
    header('Location: index.php');
}

//take information from session
$username = $_SESSION['username'];
$token = $_SESSION['token'];

//attempt to find key on session database
$dbJob = $dbJob->prepare('SELECT * FROM session WHERE username = :username');
$dbJob->bindParam(':username', $username);
$dbJob->execute();

$row = $dbJob->fetch(PDO::FETCH_ASSOC);

if (!password_verify($token, $row['key_token'])) {
    header('Location: index.php');
}
