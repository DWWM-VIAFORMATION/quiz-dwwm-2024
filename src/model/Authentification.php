<?php
namespace app\quizz\model;
class Authentification
{
    private static ?Authentification $_instance = null;
    private ?Utilisateur $_utilisateur= null;
    private function __construct() {

    }
    public static function getInstance()
    {
        if (self::$_instance ==null)
        self::$_instance= new Authentification();
        return self::$_instance;
    }
    public function login(Utilisateur $utilisateur)
    {
        $_SESSION['UTILISATEUR_ID']=$utilisateur->getId();
        $_SESSION['UTILISATEUR_RANK']=$utilisateur->getRank();
    }
    
    public function logout()
    {
        unset($_SESSION['UTILISATEUR_ID']);
        unset($_SESSION['UTILISATEUR_RANK']);
        session_destroy();
    }
    public function getUtilisateurConnecte():?Utilisateur
    {
        if (isset($_SESSION['UTILISATEUR_ID'])&&is_numeric($_SESSION['UTILISATEUR_ID']))
        {
            return Utilisateur::read($_SESSION['UTILISATEUR_ID']);
        }
        return null;
    }


    
}

