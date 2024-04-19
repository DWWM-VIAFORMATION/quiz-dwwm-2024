<?php
declare(strict_types=1);
namespace app\quizz\model;
class Utilisateur
{
    private string $_username;
    private string $_password;
    private string $_rank;
    private int $_id;
    static string $grain_sable = "user_quizz";
    /**
     * Attention:passwordEncrypted doit bien contenir un mot de passe crypté!
     * La methode Utilisateur::encryptPassword($password) permet de le crypter si besoin!
     */
    public function __construct(string $username,string $passwordEncrypted,string $rank="USER",int $id=0) {
        $this->_id=$id;
        $this->_username = $username;
        $this->_password = $passwordEncrypted;
        $this->_rank = $rank;
    }
    public function getId():int
    {
        return $this->_id;
    }
    public function getUserName():string
    {
        return $this->_username;
    }
    public function getRank():string
    {
        return $this->_rank;
    }
    public function setPassword(string $password)
    {
        $this->_password = Utilisateur::encryptPassword($password);
    }
    public function getEncryptedPassword():string
    {
        return $this->_password;
    }
    public static function encryptPassword(string $password):string
    {
        return openssl_encrypt($password, "AES-128-ECB" ,Config::getInstance()->getCryptageKey().Utilisateur::$grain_sable);
    }

 /** IMPLEMENTATION DU CRUD */

    public static function create (Utilisateur $utilisateur):int
    {
        $statement=Database::getInstance()->getConnexion()->prepare("INSERT INTO utilisateur (username,password,rank_utilisateur) values (:username,:password,rank_utilisateur:rank_utilisateur);");
        $statement->execute(['username'=>$utilisateur->getUserName(),'password'=>$utilisateur->getEncryptedPassword(),'rank_utilisateur'=>$utilisateur->getRank()]);
        return (int)Database::getInstance()->getConnexion()->lastInsertId();
    }
    public static function read(int $id):?Utilisateur
    {
        $statement=Database::getInstance()->getConnexion()->prepare('select * from utilisateur where id =:id;');
        $statement->execute(['id'=>$id]);
        if ($row = $statement->fetch())
            return new Utilisateur(id:$row['id'],username:$row['username'],passwordEncrypted:$row['password'],rank:$row['rank_utilisateur']);;
        return null;
    }
    public static function update(Utilisateur $utilisateur)
    {
        $statement = Database::getInstance()->getConnexion()->prepare('UPDATE utilisateur set username=:username, password =:password, rank_utilisateur =:rank_utilisateur WHERE id =:id');
        $statement->execute(['username'=>$utilisateur->getUserName(),'password'=>$utilisateur->getEncryptedPassword(),'id'=>$utilisateur->getId(),'rank_utilisateur'=>$utilisateur->getRank()]);
    }
    public static function delete(Utilisateur $utilisateur)
    {
        $statement = Database::getInstance()->getConnexion()->prepare('DELETE FROM utilisateur WHERE id =:id');
        $statement->execute(['id'=>$utilisateur->getId()]);
    }
    /**
     * Methodes spécifiques au mot de passe
     */
    public static function checkUsernamePassword(string $username,string $password):?Utilisateur
    {
        $passwordEncrypted = Utilisateur::encryptPassword($password);
        $statement=Database::getInstance()->getConnexion()->prepare('select * from utilisateur where username =:username and password=:password;');
        $statement->execute(['username'=>$username,'password'=>$passwordEncrypted]);
        if ($row = $statement->fetch())
            return new Utilisateur(id:$row['id'],username:$row['username'],passwordEncrypted:$row['password'],rank:$row['rank_utilisateur']);;
        return null;
    }
}