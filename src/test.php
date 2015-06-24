<?php
session_start();
$_SESSION = [
	'username' => 'izzan',
	'token'    => 'test',
	];
include('/libs/Session.php');
?>