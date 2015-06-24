<?php
/**
*	Copyright Smalarobotics 2015
*	Cybernature Project
*	Alifa Izzan
*/

session_start();
$conf = require __DIR__.'/../libs/config.php';
$dbJob = new PDO("mysql:host={$conf['dbHost']};dbname={$conf['dbName']}", $conf['dbUser'], $conf['dbPass']);

if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
echo "Username or Password is invalid";
}
else
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(password_verify($password, password_hash($conf['password'],PASSWORD_DEFAULT)&&password_verify($username,password_hash($conf['username'],PASSWORD_DEFAULT))
	{
		$keytoken = rand(0,1000);
		$token = password_hash($keytoken, PASSWORD_DEFAULT);
		$dbJob = $dbJob->prepare("SELECT * FROM session WHERE username = :username");
		$dbJob->bindParam(':username', $username);
		$dbJob->execute();
		
		if ($dbJob->rowCount() > 0)
		{
			$dbJob = $dbJob->prepare("UPDATE session SET username = :name, key_token = :key");
			$dbJob->bindParam(':name', $username);
			$dbJob->bindParam(':key' , $token);	
		}
		else
		{
			$dbJob = $dbJob->prepare("INSERT INTO session (username,key_token) VALUES(:name, :key)");
			$dbJob->bindParam(':name', $username);
			$dbJob->bindParam(':key' , $token);
		}	
		
		$dbJob->execute();
		
		$_SESSION = [
		'username' => $username, 'token' => $token,
		];
		header("Location: admin");
	}
	else
	{
		echo 'username atau password salah';
	}
}
}
else
{
	header("Location: index.php");
}
?>