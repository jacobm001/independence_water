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
			if(in_array($interval, $this->valid_intervals))
				return true;
			
			throw new Exception("Bad interval value.");
			die();
		}

		private function interval_format($interval)
		{
			switch($interval)
			{
				case 'hour':  return 'Y-m-d H';
				case 'day':   return 'Y-m-d';
				case 'month': return 'Y-m';
				case 'year':  return 'Y';
			}
		}
		
		public function get_meter_data($meter, $interval) 
		{
			$this->validate_interval($interval);
			
			$query = "select strftime(:tformat, time_read) as `timestamp`, sum(value) from meter_read where meter_id = :meter_id group by strftime(:tformat, time_read)";
			$stmt  = $this->db->prepare($query);

			$stmt->bindParam(':tformat', $this->interval_format($interval));
			$stmt->bindParam(':meter_id', $meter, PDO::PARAM_INT);
			$stmt->execute();

			$result = $stmt->fetchAll();
			print_r($result);
		}
	}
?>