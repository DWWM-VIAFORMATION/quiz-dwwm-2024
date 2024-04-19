<?php
namespace app\quizz\model;
class Config
{
    private static ?Config $_instance = null;
    private ?array $_configuration = [];
    private function __construct() {
        $this->_configuration = require('./../config/config.php');
    }
    public static function getInstance()
    {
        if (self::$_instance ==null)
        self::$_instance= new Config();
        return self::$_instance;
    }
    public function getDbHost():string
    {
        return $this->_configuration['database_host'];
    }
    public function getDbName():string
    {
        return $this->_configuration['database_name'];
    }
    public function getDbUserName():string
    {
        return $this->_configuration['database_username'];
    }
    public function getDbUserPassword():string
    {
        return $this->_configuration['database_password'];
    }
    public function getCryptageKey():string
    {
        return $this->_configuration['cryptage_key'];
    }

    
}

