#!/usr/bin/php
<?php
	include "../api/Init.php";
	include "../api/DataImporter.php";

	$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("./historical_data"));
	$Regex   = new RegexIterator($objects, '/^.+\.txt$/i', RecursiveRegexIterator::GET_MATCH);
	
	foreach($Regex as $name => $object) {
		echo "Importing file: " . $name . "\n";
		new DataImporter($db, file_get_contents($name));
	}
?>
