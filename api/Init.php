<?php 
	// Configuration area
	$GLOBALS['storage_directory']  = '../storage';
	$GLOBALS['database_direcotry'] = $GLOBALS['storage_directory'] . '/data.db';

	// Ensure datbase exists
	// See 
	if(file_exists($GLOBALS['database_directory'])) {
		$db = new PDO($GLOBALS['database_directory']);
	} else {
		$db            = new PDO($GLOBALS['database_directory']);
		$db_create_sql = file_get_contents($GLOBALS['storage_directory'] . '/schema.sql');
		$db->exec($db_create_sql);
	}
?>