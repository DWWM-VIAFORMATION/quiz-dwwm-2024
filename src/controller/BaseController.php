<?php
namespace app\quizz\controller;
use app\quizz\router\HttpRequest;
use app\quizz\router\ViewNotFoundException;
    abstract class BaseController
    {
        protected HttpRequest $_httpRequest;
        protected $_params=[];
        
        public function __construct($httpRequest)
        {
            $this->_httpRequest = $httpRequest;
            $this->_params=$httpRequest->getParams();
        }
        public function view($filename)
        {
            $viewFile= './../templates/' . $filename . '.php';
            if(file_exists($viewFile))
            {
                ob_start();
                // ['id'=>5,'text'=>"salut"]
                extract($this->_params);
                // extract donnerait
                // $id=5;$text="salut";
                include($viewFile);
                $content = ob_get_clean();
                include("./../templates/layout.php");
            }
            else
            {
                throw new ViewNotFoundException($viewFile); 
            }
        }
        public function addParam($name,$value)
        {
            $this->_params[$name] = $value;
        }
        public function getParams()
        {
            return $this->_params;
        }

        public function redirectTo(string $route)
        {
            header("Location: $route");
            die();
        }
    }
