#!/usr/bin/php
<?php
	include "../api/Init.php";
	include "../api/AbzuDB.php";

	print_r($db);
	$AbzuDB = new AbzuDB($db);
	$AbzuDB->get_meter_data("11602994", "year");
?>
