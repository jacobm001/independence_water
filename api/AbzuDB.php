<?php
	class AbzuDB
	{
		private $db;
		private $qry_meter_read_sm;
		private $qry_meter_read_lg;

		private $valid_intervals = [
			// "hour",
			"day",
			"week",
			"month",
			"year"
		];
		
		public function __construct(&$db)
		{
			$this->db = $db;

			$this->qry_meter_read_sm = file_get_contents("../api/queries/get_meter_read_sm.sql");
			$this->qry_meter_read_lg = file_get_contents("../api/queries/get_meter_read_lg.sql");
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
				// case 'hour':  return '%Y-%m-%d %H';
				case 'day':   return '%Y-%m-%d';
				case 'week':  return '%Y-%W';
				case 'month': return '%Y-%m';
				case 'year':  return '%Y';
			}
		}

		private function decrement_value($interval)
		{
			switch($interval)
			{
				case 'hour':  return Null;
				case 'day':   return '-1 day';
				case 'week':  return '-1 week';
				case 'month': return '-1 month';
				case 'year':  return '-1 year';
			}
		}

		private function choose_query($interval)
		{
			if($interval == 'day')
				return 'sm';
			else
				return 'lg';
		}

		private function clean_return_data($result)
		{
			$ret = "timestamp,value\n";
			foreach($result as $row) {
				$ret .= $row["timestamp"] . "," . $row["value"] . "\n";
			}

			print_r($ret);
			return $ret;
		}
		
		public function get_meter_data($meter, $interval) 
		{
			$this->validate_interval($interval);
			
			$interval_format = $this->interval_format($interval);
			$dec_value       = $this->decrement_value($interval);
			
			$query_option = $this->choose_query($interval);

			if($query_option == 'sm') {
				$stmt = $this->db->prepare($this->qry_meter_read_sm);
				$stmt->bindParam(':dec_value', $dec_value, PDO::PARAM_STR);
			}
			else {
				$stmt = $this->db->prepare($this->qry_meter_read_lg);
			}
			
			$stmt->bindParam(':tformat', $interval_format, PDO::PARAM_STR);
			$stmt->bindParam(':meter_id', $meter, PDO::PARAM_INT);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $this->clean_return_data($result);
		}
	}
?>