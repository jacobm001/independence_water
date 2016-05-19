<?php
	class AbzuDB
	{
		private $db;
		
		private $qry_meter_ids;
		private $qry_meter_read_sm;
		private $qry_meter_read_lg;
		private $qry_meter_insert;
		private $qry_city_avg_sm;
		private $qry_city_avg_lg;
		private $qry_guage_to_date_sm;
		private $qry_guage_to_date_lg;
		private $qry_check_user_cred;

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

			$this->qry_meter_ids        = file_get_contents("../api/queries/get_meter_ids.sql");
			$this->qry_meter_read_sm    = file_get_contents("../api/queries/get_meter_read_sm.sql");
			$this->qry_meter_read_lg    = file_get_contents("../api/queries/get_meter_read_lg.sql");
			$this->qry_meter_insert     = file_get_contents("../api/queries/insert_meter_data.sql");
			$this->qry_city_avg_sm      = file_get_contents("../api/queries/get_city_avg_sm.sql");
			$this->qry_city_avg_lg      = file_get_contents("../api/queries/get_city_avg_lg.sql");
			$this->qry_guage_to_date_sm = file_get_contents("../api/queries/get_gauge_to_date_sm.sql");
			$this->qry_guage_to_date_lg = file_get_contents("../api/queries/get_gauge_to_date_lg.sql");
			$this->qry_get_day_avg      = file_get_contents("../api/queries/get_day_average.sql");
			$this->qry_check_user_cred  = file_get_contents("../api/queries/check_user_credentials.sql");
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

		public function get_city_avg_data($interval) 
		{
			$this->validate_interval($interval);
			
			$interval_format = $this->interval_format($interval);
			$dec_value       = $this->decrement_value($interval);
			
			$query_option = $this->choose_query($interval);

			if($query_option == 'sm') {
				$stmt = $this->db->prepare($this->qry_city_avg_sm);
				$stmt->bindParam(':dec_value', $dec_value, PDO::PARAM_STR);
			}
			else {
				$stmt = $this->db->prepare($this->qry_city_avg_lg);
			}
			
			$stmt->bindParam(':tformat', $interval_format, PDO::PARAM_STR);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $this->clean_return_data($result);
		}

		public function get_gauge_to_date($meter, $interval, $period)
		{
			$this->validate_interval($interval);
			$interval_format = $this->interval_format($interval);
			$query_option = $this->choose_query($interval);

			if($query_option == 'sm') {
				$stmt = $this->db->prepare($this->qry_guage_to_date_sm);
				$stmt->bindParam(':dec_value', $dec_value, PDO::PARAM_STR);
			}
			else {
				$stmt = $this->db->prepare($this->qry_guage_to_date_lg);
			}

			$stmt->bindParam(':meter_id', $meter);
			$stmt->bindParam(':tformat', $interval_format);
			$stmt->bindParam(':period', $period);
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result["value"];
		}

		private function verify_timestamp($timestamp)
		{
			try {
				$t = new DateTime($timestamp);
			}
			catch (Exception $e) {
				die("unsupported date format\n");
			}

			return $t->format('Y-m-d H:i');
		}

		public function insert_meter_data($meter, $value, $timestamp)
		{
			$stmt = $this->db->prepare($this->qry_meter_insert);
			$t    = $this->verify_timestamp($timestamp);
			
			$stmt->bindParam(':meter_id',  $meter);
			$stmt->bindParam(':value',     $value);
			$stmt->bindParam(':time_read', $t);

			$stmt->execute();
		}

		public function get_day_average($meter)
		{
			$stmt = $this->db->prepare($this->qry_get_day_avg);
			$stmt->bindParam(':meter_id', $meter);
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result["value"];
		}

		public function load_historical_data($f)
		{
			try {
				new DataImporter($this->db, $f);
			}
			catch (Exception $e) {
				die("bad import file");
			}
		}

		public function check_credentials($user, $pass)
		{
			$stmt = $this->db->prepare($this->qry_check_user_cred);
			$stmt->bindParam(':username', $user);
			$stmt->bindParam(':password', $pass);
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if( $result == 0 ) {
				echo 'False';
			}
			else {
				echo 'True';
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}
?>