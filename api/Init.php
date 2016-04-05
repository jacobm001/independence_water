<?php 
	// Configuration area
	$GLOBALS['storage_directory']  = '../storage';
	$GLOBALS['database_path'] = $GLOBALS['storage_directory'] . '/data.db';

	// Ensure datbase exists
	// See 
	if(file_exists($GLOBALS['database_path'])) {
		$db = new PDO("sqlite:" . $GLOBALS['database_path']);
	} else {
		$db            = new PDO("sqlite:" . $GLOBALS['database_path']);
		$db_create_sql = file_get_contents($GLOBALS['storage_directory'] . '/schema.sql');
		$db->exec($db_create_sql);
	}
?>