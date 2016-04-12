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
			
			if ($params[0] == "api"){
				if ($params[2] == "daychart"){
					//api call
				}
				if ($params[2] == "weekchart"){
					//api call
				}
				if ($params[2] == "monthchart"){
					//api call
				}
				if ($params[2] == "daytotalchart"){
					//api call
				}
				if ($params[2] == "weektotalchart"){
					//api call
				}
				if ($params[2] == "monthtotalchart"){
					//api call
				}
				if ($params[2] == "daytable"){
					//api call
				}
				if ($params[2] == "weektable"){
					//api call
				}
				if ($params[2] == "monthtable"){
					//api call
				}
				if ($params[2] == "dayaverage"){
					//api call
				}
				if ($params[2] == "monthtodate"){
					//api call
				}
				if ($params[2] == "yeartodate"){
					//api call
				}
				if ($params[2] == "daycityaverage"){
					//api call
				}
				if ($params[2] == "weekcityaverage"){
					//api call
				}
				if ($params[2] == "monthcityaverage"){
					//api call
				}
			}
			$AbzuDB->get_meter_data(:meter_id, :increment)
			$AbzuDB->insert_meter_data(:meter_id, :value, :timestamp)
			$AbzuDB->load_historical_data(:file_contents)
			// echo $uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
		
			// foreach ($this->_uri as $key => $value)
			// {
				// if (preg_match("#$^value$#", $uriGetParam))
				// {
					// $useMethod = $this->_method[$key];
					// new $useMethod;
				// }
			// }
		}
	}
	?>