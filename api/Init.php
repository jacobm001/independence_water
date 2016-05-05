<?php 
	// Configuration area
	$GLOBALS['storage_directory']  = "../storage";
	$GLOBALS["database_path"] = $GLOBALS["storage_directory"] . "/data.db";

	ini_set("display_errors", 1);
	ini_set("display_startup_errors", 1);
	error_reporting(E_ALL); 

	// Ensure datbase exists
	if(file_exists($GLOBALS["database_path"])) {
		$db = new PDO("sqlite:" . $GLOBALS["database_path"]);
	} else {
		$db            = new PDO("sqlite:" . $GLOBALS["database_path"]);
		$db_create_sql = file_get_contents($GLOBALS["storage_directory"] . "/schema.sql");
		$db->exec($db_create_sql);

		$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("../tools/historical_data"));
		$Regex   = new RegexIterator($objects, '/^.+\.txt$/i', RecursiveRegexIterator::GET_MATCH);

		foreach($Regex as $name => $object) {
			echo "Importing file: " . $name . "\n";
			$DI = new DataImporter($db, file_get_contents($name));

			// most of the supplied files have the address as part of the filename		
			$str = explode("/", $name);
			if(count($str) == 4) {
				$query = "insert into meter_info(`meter_id`, `address`) values(:meter_id, :address);";
				$stmt = $db->prepare($query);

				$id = $DI->get_meter_id();
				
				$stmt->bindParam(':meter_id', $id);
				$stmt->bindParam(':address', $str[2]);
				$stmt->execute();
			}
			// insert what doesn't fit the pattern described above
			else {
				$query = "insert into meter_info(`meter_id`, `address`) values(:meter_id, 'unknown');";
				$stmt = $db->prepare($query);

				$id = $DI->get_meter_id();
				
				$stmt->bindParam(':meter_id', $id);
				$stmt->execute();
			}
		}
	}
?>