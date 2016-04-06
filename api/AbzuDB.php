<?php
	class AbzuDB
	{
		private $db;
		private $qry_meter_group;
		private $valid_intervals = [
			"day",
			"week",
			"month",
			"year"
		];
		
		public function __construct(&$db)
		{
			$this->db = $db;
			$this->qry_meter_group = file_get_contents("../api/queries/get_meter_read.sql");
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
				case 'hour':  return '%Y-%m-%d %H';
				case 'day':   return '%Y-%m-%d';
				case 'week':  return '%Y-$W';
				case 'month': return '%Y-%m';
				case 'year':  return '%Y';
			}
		}
		
		public function get_meter_data($meter, $interval) 
		{
			$this->validate_interval($interval);
			$format = $this->interval_format($interval);
			
			$stmt  = $this->db->prepare($this->qry_meter_group);
			$stmt->bindParam(':tformat', $format);
			$stmt->bindParam(':meter_id', $meter, PDO::PARAM_INT);
			$stmt->execute();

			$result = $stmt->fetchAll();
			print_r($result);
		}
	}
?>