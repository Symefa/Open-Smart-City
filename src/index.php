<?php

/**
 *	Open Smart City Project.
 */
require_once 'libs/Points.php';
require_once 'libs/Point.php';
$Points = new Points(null);
if (isset($_GET['action'])) {
    $Array = $Points->getPoints();
    echo json_encode($Array);
} else {
    echo ' <!DOCTYPE html>
<html>
	<head>
		<title>'.$Points->getTitle().'</title>
		<script type="text/javascript" src="http://www.google.com/jsapi?key='.$Points->getApi().'"></script>
		<script type="text/javascript" src="js/exec.js"></script>
		<link rel="stylesheet" type="text/css" href="css/main.css" media="screen"></link>
		<script type="text/javascript" src="js/main.js"></script>
	</head>
	<body>
		<div class="wrapper">
			<div class="header"><center><h1>'.$Points->getTitle().'</h1></center></div>
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
}
