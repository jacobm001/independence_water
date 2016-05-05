<?php 
	include 'DataImporter.php';
	include 'Init.php';
	include 'AbzuDB.php';
	include 'Route.php';
	
	$AbzuDB = new AbzuDB($db);

	$route = new Route($AbzuDB);
	$route->submit();
?>
