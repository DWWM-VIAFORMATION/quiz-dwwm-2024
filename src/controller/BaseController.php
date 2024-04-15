<?php
namespace app\quizz\controller;
	class BaseApiController
	{
		private $_httpRequest;
		private $_param;
		
		public function __construct($httpRequest)
		{
			$this->_httpRequest = $httpRequest;
		}
		
		protected function view($data, $param)
		{
            echo "view";
		}
	
	}