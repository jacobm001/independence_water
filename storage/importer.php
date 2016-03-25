<?php 
	$file = @fopen('meter11602994.txt', 'r');
	// $data = [];

	if($file) {
		$line_number = 0;

		while(($line = fgets($file)) !== false) {
			if($line_number >= 8) {
				preg_match('/= [0-9]+/', $line, $read);
				$read = substr($read[0], 2);

				preg_match('/Time: .+/', $line, $time);
				$time = substr($time[0], 6);

				if( $read != null and $time != null)
					echo $read . ';' . $time . "\n";
			}

			$line_number++;
		}
	}
?>