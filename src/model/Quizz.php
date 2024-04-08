<?php
namespace app\quizz\model;
class Quizz{
    private string $_title;
    private int $_id;
    public function __construct(string $title = 'No title choosen',int $id = 0) {
        $this->_title = $title;
        $this->_id=$id;
    }
    public function getTitle():string
    {
        return $this->_title;
    }
    public static function list():\ArrayObject{
        $liste = new \ArrayObject();
        $statement=Database::getInstance()->getConnexion()->prepare('select * from quiz;');
        $statement->execute();
        while ($row = $statement->fetch()) {
            $liste[] = new Quizz(id:$row['id'],title:$row['title']);
        }
        return $liste;
    }
    public static function findById(int $id):?Quizz
    {
        $statement=Database::getInstance()->getConnexion()->prepare('select * from quiz where id =:id;');
        $statement->execute(['id'=>$id]);
        if ($row = $statement->fetch())
        return new Quizz(id:$row['id'],title:$row['title']);
        return null;
    }
    public static function filter(string $texte):\ArrayObject{
        $liste = new \ArrayObject();
        $statement=Database::getInstance()->getConnexion()->prepare("select * from quiz where title like :textSearched;");
        $statement->execute(['textSearched'=>'%'.$texte.'%']);
        while ($row = $statement->fetch()) {
            $liste[] = new Quizz(id:$row['id'],title:$row['title']);
        }
        return $liste;
    }
    public static function createDB (Quizz $quiz)
    {
        $statement=Database::getInstance()->getConnexion()->prepare("INSERT INTO quiz (title) values (:title);");
        $statement->execute(['title'=>$quiz->getTitle()]);
    }

}