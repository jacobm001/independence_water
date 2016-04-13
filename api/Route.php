<?php
	include 'AbzuDB.php';
	
	class Route{
		private $_uri = [];
		private $_method = [];
	
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
			$params = explode("/", $uriGetParam);
			$db_api = new AbzuDB();
			
			if ($params[0] == "api"){
				if ($params[2] == "daychart"){
					echo $db_api->get_meter_data($params[1], "day");
				}
				if ($params[2] == "weekchart"){
					echo $db_api->get_meter_data($params[1], "week");
				}
				if ($params[2] == "monthchart"){
					echo $db_api->get_meter_data($params[1], "month");
				}
				if ($params[2] == "daytotalchart"){
					echo $db_api->get_meter_data($params[1], "day");
				}
				if ($params[2] == "weektotalchart"){
					echo $db_api->get_meter_data($params[1], "week");
				}
				if ($params[2] == "monthtotalchart"){
					echo $db_api->get_meter_data($params[1], "month");
				}
				if ($params[2] == "daytable"){
					echo $db_api->get_meter_data($params[1], "day");
				}
				if ($params[2] == "weektable"){
					echo $db_api->get_meter_data($params[1], "week");
				}
				if ($params[2] == "monthtable"){
					echo $db_api->get_meter_data($params[1], "month");
				}
				if ($params[2] == "dayaverage"){
					echo $db_api->get_gauge_to_date($params[1], "day", $params[3]);
				}
				if ($params[2] == "monthtodate"){
					echo $db_api->get_gauge_to_date($params[1], "month", $params[3]);
				}
				if ($params[2] == "yeartodate"){
					echo $db_api->get_gauge_to_date($params[1], "year", $params[3]);
				}
				if ($params[2] == "daycityaverage"){
					echo $db_api->get_city_avg_data($params[1], "day");
				}
				if ($params[2] == "weekcityaverage"){
					echo $db_api->get_city_avg_data($params[1], "week");
				}
				if ($params[2] == "monthcityaverage"){
					echo $db_api->get_city_avg_data($params[1], "month");
				}
			} else {
				echo "Invalid route";
			}
		}
	}
	?>