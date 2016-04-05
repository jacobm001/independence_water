<?php
	class AbzuDB
	{
		private $db;
		private $valid_intervals = [
			"day",
			"month",
			"week",
			"year"
		];
		
		public function __constructor(&$db)
		{
			$this->db = $db;
		}

		private function validate_interval($interval)
		{
			if($interval in $this->valid_intervals)
				return true;
			else
				return false;
		}
		
		public function get_meter_data($meter, $interval) 
		{
			if($this->validate_interval($interval) == false)
				throw new Exception("Bad interval value.");
			
			$query = "select strftime(:tformat, time_read) as `timestamp`, sum(value) from meter_read where meter_id = :meter_id group by strftime(:tformat, time_read)";
			$stmt = $this->db->prepare($query);
		}
	}
?>