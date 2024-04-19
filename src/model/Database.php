<?php
namespace app\quizz\model;
class Database
{
    private static ?Database $_instance = null;
    private ?\PDO $_connexion = null;
    private function __construct() {
        $this->_connexion = new \PDO('mysql:host='.Config::getInstance()->getDbHost().';dbname='.Config::getInstance()->getDbName(),Config::getInstance()->getDbUserName(),Config::getInstance()->getDbUserPassword());
    }
    public static function getInstance()
    {
        if (self::$_instance ==null)
        self::$_instance= new Database();
        return self::$_instance;
    }
    public function getConnexion():\PDO
    {
        return $this->_connexion;
    }
}

