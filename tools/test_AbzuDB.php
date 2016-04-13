#!/usr/bin/php
<?php
	require "../api/Init.php";
	require "../api/AbzuDB.php";

	$AbzuDB = new AbzuDB($db);
	echo $AbzuDB->get_gauge_to_date("7813517", "month", "2016-03") . "\n";
	// $AbzuDB->get_meter_data("7813517", "week");
	// $AbzuDB->insert_meter_data("042014", "01245", "10/Oct/2000:13:55:36 -0700");
?>
