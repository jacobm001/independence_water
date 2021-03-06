<?php 
	class DataImporter
	{
		private $db;
		private $contents;
		private $meter_id;

		public function __construct(&$db, $contents)
		{
			$this->db = $db;
			$this->contents = $contents;
			$this->submit_file();
		}

		private function submit_file()
		{
			$sql  = 'insert into meter_read(meter_id,value,time_read) values(?,?,?)';
			$stmt = $this->db->prepare($sql);

			$line_number = 0;
			$lines = explode("\n", $this->contents);

			foreach($lines as $line) 
			{
				if($line_number == 0) {
					preg_match('/[0-9]+/', $line, $meter);
					$this->meter_id = $meter[0];
				}

				else if($line_number >= 8) {
					preg_match('/= [0-9]+/', $line, $read);
					if(!empty($read))
						$read = substr($read[0], 2);

					preg_match('/Time: .+/', $line, $time);
					if(!empty($read)) {
						$time = substr($time[0], 6);
						$time = strtotime($time);
						$time = date('Y-m-d H:i',$time);
					}

					if($read != null and $time != null)
						$stmt->execute(array($this->meter_id, $read, $time));
				}

				$line_number++;
			}
		}

		public function get_meter_id()
		{
			return $this->meter_id;
		}
	}
?>