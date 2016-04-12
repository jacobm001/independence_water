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