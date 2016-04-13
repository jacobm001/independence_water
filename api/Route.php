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
			
			//if ($params[0] == "api"){
				if ($params[1] == "daychart"){
					echo $this->AbzuDB->get_meter_data($params[0], "day");
				}
				if ($params[1] == "weekchart"){
					echo $this->AbzuDB->get_meter_data($params[0], "week");
				}
				if ($params[1] == "monthchart"){
					echo $this->AbzuDB->get_meter_data($params[0], "month");
				}
				if ($params[1] == "daytotalchart"){
					echo $this->AbzuDB->get_meter_data($params[0], "day");
				}
				if ($params[1] == "weektotalchart"){
					echo $this->AbzuDB->get_meter_data($params[0], "week");
				}
				if ($params[1] == "monthtotalchart"){
					echo $this->AbzuDB->get_meter_data($params[0], "month");
				}
				if ($params[1] == "daytable"){
					echo $this->AbzuDB->get_meter_data($params[0], "day");
				}
				if ($params[1] == "weektable"){
					echo $this->AbzuDB->get_meter_data($params[0], "week");
				}
				if ($params[1] == "monthtable"){
					echo $this->AbzuDB->get_meter_data($params[0], "month");
				}
				if ($params[1] == "dayaverage"){
					echo $this->AbzuDB->get_day_average($params[0]);
				}
				if ($params[1] == "monthtodate"){
					echo $this->AbzuDB->get_gauge_to_date($params[0], "month", $params[2]);
				}
				if ($params[1] == "yeartodate"){
					echo $this->AbzuDB->get_gauge_to_date($params[0], "year", $params[2]);
				}
				if ($params[1] == "daycityaverage"){
					echo $this->AbzuDB->get_city_avg_data($params[0], "day");
				}
				if ($params[1] == "weekcityaverage"){
					echo $this->AbzuDB->get_city_avg_data($params[0], "week");
				}
				if ($params[1] == "monthcityaverage"){
					echo $this->AbzuDB->get_city_avg_data($params[0], "month");
				}
			// } else {
			// 	echo "Invalid route";
			// }
		}
	}
	?>