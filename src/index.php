<?php

/**
 *	Open Smart City Project.
 */
require 'libs/Points.php';
require 'libs/Main.php';
require 'libs/AltoRouter.php';

$router = new AltoRouter();
$router->setBasePath('/opensmartcity/src/');
$router->map( 'GET', 'listpoints', function() {
    $Points = new Points();
	echo json_encode($Points->getPoints());
	exit();
});
        
$match = $router->match();

if( $match && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
}

echo ' <!DOCTYPE html>
<html>
	<head>
		<title>'.Main::getTitle().'</title>
		<script type="text/javascript" src="http://www.google.com/jsapi?key='.Main::getApi().'"></script>
		<script type="text/javascript" src="js/exec.js"></script>
		<link rel="stylesheet" type="text/css" href="css/main.css" media="screen"></link>
		<script type="text/javascript" src="js/main.js"></script>
	</head>
	<body>
		<div class="wrapper">
			<div class="header"><center><h1>'.Main::getTitle().'</h1></center></div>
				<div class="content">
					<div class="map wrapper">
						<table>
						<tr>
						<td><ul id="keluhan">Keluhan Masyarakat</ul><ul id="list"></ul></td>
						<td><div id="map"></div></td>

						</tr>
						</table>
					</div>
				<div id="message"></div>
			</div>
			<div class="footer">Developed by Alifa Izzan, Smalarobotics 2016 for CyberNature. Supported By Kakatoagames</div>
		</div>
	</body>
</html>'
;

