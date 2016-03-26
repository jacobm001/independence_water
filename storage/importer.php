<?php 
	if(file_exists('data.db'))
		$db  = new PDO('sqlite:data.db');
	else {
		$db  = new PDO('sqlite:data.db');
		$sql = file_get_contents('schema.sql');
		$db->exec($sql);
	}
	
	$file = @fopen('meter11602994.txt', 'r');

	$sql = 'insert into meter_read(meter_id,value,time_read) values(?,?,?)';
	$stmt = $db->prepare($sql);

	if($file) {
		$line_number = 0;

		while(($line = fgets($file)) !== false) {
			if($line_number == 0) {
				preg_match('/[0-9]+/', $line, $meter);
				$meter = $meter[0];
			}

			else if($line_number >= 8) {
				preg_match('/= [0-9]+/', $line, $read);
				if(!empty($read))
					$read = substr($read[0], 2);

				preg_match('/Time: .+/', $line, $time);
				if(!empty($read))
					$time = substr($time[0], 6);

				if( $read != null and $time != null)
					$stmt->execute(array($meter, $read, $time));
			}

			$line_number++;
		}
	}
?>