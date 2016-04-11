#!/usr/bin/php
<?php
	include "../api/Init.php";
	include "../api/DataImporter.php";

	$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("./historical_data"));
	$Regex   = new RegexIterator($objects, '/^.+\.txt$/i', RecursiveRegexIterator::GET_MATCH);
	
	$query = "insert into meter_info(`meter_id`, `address`) values(:meter_id, :address);";
	$stmt = $db->prepare($query);

	foreach($Regex as $name => $object) {
		echo "Importing file: " . $name . "\n";
		$DI = new DataImporter($db, file_get_contents($name));
		
		$str = explode("/", $name);
		if(count($str) == 4) {
			$id = $DI->get_meter_id();
			
			$stmt->bindParam(':meter_id', $id);
			$stmt->bindParam(':address', $str[2]);
			$stmt->execute();
		}
	}
?>
