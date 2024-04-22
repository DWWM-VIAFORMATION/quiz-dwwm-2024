<?php
declare(strict_types=1);
namespace app\quizz\model;
use app\quizz\router\NotAllowedException;
class Utilisateur
{
    private string $_username;
    private string $_passwordHashed;
    private string $_rank;
    private int $_id;

    public function __construct(string $username,string $passwordHashed,string $rank="USER",int $id=0) {

        $this->_id=$id;
        $this->_username = $username;
        $this->_passwordHashed = $passwordHashed;
        $this->_rank = $rank;
    }
    public function getId():int
    {
        return $this->_id;
    }


    public function setUserName(string $username):void
    {
        $this->_username = $username;
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
        $this->_passwordHashed = password_hash(password:$password,algo: PASSWORD_ARGON2ID);
    }
    public function getPassword():string
    {
        return $this->_passwordHashed;
    }
 /** IMPLEMENTATION DU CRUD */

    public static function create (Utilisateur $utilisateur):int
    {
        $passwordHashed = password_hash(password:$utilisateur->getPassword(),algo: PASSWORD_ARGON2ID);
        $statement=Database::getInstance()->getConnexion()->prepare("INSERT INTO utilisateur (username,password,rank_utilisateur) values (:username,:password,:rank_utilisateur);");
        $statement->execute(['username'=>$utilisateur->getUserName(),'password'=>$utilisateur->getPassword(),'rank_utilisateur'=>$utilisateur->getRank()]);
        return (int)Database::getInstance()->getConnexion()->lastInsertId();
    }
    public static function read(int $id):?Utilisateur
    {
        $statement=Database::getInstance()->getConnexion()->prepare('select * from utilisateur where id =:id;');
        $statement->execute(['id'=>$id]);
        if ($row = $statement->fetch())
            return new Utilisateur(id:$row['id'],username:$row['username'],passwordHashed:$row['password'],rank:$row['rank_utilisateur']);;
        return null;
    }
    public static function update(Utilisateur $utilisateur)
    {
        $statement = Database::getInstance()->getConnexion()->prepare('UPDATE utilisateur set username=:username, password =:password, rank_utilisateur =:rank_utilisateur WHERE id =:id');
        $statement->execute(['username'=>$utilisateur->getUserName(),'password'=>$utilisateur->getPassword(),'id'=>$utilisateur->getId(),'rank_utilisateur'=>$utilisateur->getRank()]);
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
        $statement=Database::getInstance()->getConnexion()->prepare('select * from utilisateur where username =:username;');
        $statement->execute(['username'=>$username]);
        if ($row = $statement->fetch())
        {
            if (password_verify($password,$row['password']))
                return new Utilisateur(id:$row['id'],username:$row['username'],passwordHashed:$row['password'],rank:$row['rank_utilisateur']);
            else
                return null;
        }

        return null;
    }
}
