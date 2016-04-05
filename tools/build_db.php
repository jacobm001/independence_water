#!/usr/bin/php
<?php
	include "../api/DataImporter.php";

	if(file_exists("../storage/data.db")) {
		$db = new PDO("sqlite:../storage/data.db");
	} else {
		$db            = new PDO("sqlite:../storage/data.db");
		$db_create_sql = file_get_contents("../storage/schema.sql");
		$db->exec($db_create_sql);
	}

	$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("."));
	$Regex   = new RegexIterator($objects, '/^.+\.txt$/i', RecursiveRegexIterator::GET_MATCH);
	foreach($Regex as $name => $object) {
		echo "Importing file: " . $name . "\n";
		new DataImporter($db, file_get_contents($name));
	}
?>
