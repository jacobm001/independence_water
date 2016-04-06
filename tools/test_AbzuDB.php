#!/usr/bin/php
<?php
	require "../api/Init.php";
	require "../api/AbzuDB.php";

	$AbzuDB = new AbzuDB($db);
	$AbzuDB->get_meter_data("7030264", "month");
?>
