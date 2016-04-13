<?php
	class Route{
		private $AbzuDB;
		private $_uri = [];
		private $_method = [];

		public function __construct(&$AbzuDB)
		{
			$this->AbzuDB = $AbzuDB;
		}
	
		public function add($uri, $method = null)
		{
				$this->_uri[] = trim($uri, '/');
			
				if ($method != null)
				{
					$this->_method[] = $method;
			}
		}

		public function submit()
		{
			$params = explode("/", $_GET['uri']);
			
			if ($params[0] == "api"){
				if ($params[2] == "daychart"){
					echo $this->AbzuDB->get_meter_data($params[1], "day");
				}
				if ($params[2] == "weekchart"){
					echo $this->AbzuDB->get_meter_data($params[1], "week");
				}
				if ($params[2] == "monthchart"){
					echo $this->AbzuDB->get_meter_data($params[1], "month");
				}
				if ($params[2] == "daytotalchart"){
					echo $this->AbzuDB->get_meter_data($params[1], "day");
				}
				if ($params[2] == "weektotalchart"){
					echo $this->AbzuDB->get_meter_data($params[1], "week");
				}
				if ($params[2] == "monthtotalchart"){
					echo $this->AbzuDB->get_meter_data($params[1], "month");
				}
				if ($params[2] == "daytable"){
					echo $this->AbzuDB->get_meter_data($params[1], "day");
				}
				if ($params[2] == "weektable"){
					echo $this->AbzuDB->get_meter_data($params[1], "week");
				}
				if ($params[2] == "monthtable"){
					echo $this->AbzuDB->get_meter_data($params[1], "month");
				}
				if ($params[2] == "dayaverage"){
					echo $this->AbzuDB->get_gauge_to_date($params[1], "day", $params[3]);
				}
				if ($params[2] == "monthtodate"){
					echo $this->AbzuDB->get_gauge_to_date($params[1], "month", $params[3]);
				}
				if ($params[2] == "yeartodate"){
					echo $this->AbzuDB->get_gauge_to_date($params[1], "year", $params[3]);
				}
				if ($params[2] == "daycityaverage"){
					echo $this->AbzuDB->get_city_avg_data($params[1], "day");
				}
				if ($params[2] == "weekcityaverage"){
					echo $this->AbzuDB->get_city_avg_data($params[1], "week");
				}
				if ($params[2] == "monthcityaverage"){
					echo $this->AbzuDB->get_city_avg_data($params[1], "month");
				}
			} else {
				echo "Invalid route";
			}
		}
	}
	?>