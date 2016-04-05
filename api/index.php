<?php 
	include 'Init.php';
	include 'DataImporter.php';
	include 'Route.php';
	include 'AbzuDB.php';
	
	$route = new Route();
	
	route->add('read/day');
	route->add('read/week');
	route->add('read/month');
	route->add('read/year');
	
	route->submit();
	echo test;
?>
