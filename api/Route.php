<?php
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
			echo $uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
		
			foreach ($this->_uri as $key => $value)
			{
				if (preg_match("#$^value$#", $uriGetParam))
				{
					$useMethod = $this->_method[$key];
					new $useMethod;
				}
			}
		}
	}
	?>