<?php
namespace app\quizz\model;
class Quizz{
    private string $_title;
    private int $_id;
    private QuestionCollection $_questions;
    public function __construct(string $title = 'No title choosen',int $id = 0) {
        $this->_title = $title;
        $this->_id=$id;
        $this->_questions = new QuestionCollection();
    }
    public function getTitle():string
    {
        return $this->_title;
    }
    public function setTitle(string $title)
    {
        $this->_title = $title;
    }
    public function getId():int
    {
        return $this->_id;
    }
    public function addQuestion(Question $question)
    {
        $this->_questions[]=$question;
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
    public function getQuestions():QuestionCollection{
        $liste = new QuestionCollection();
        $statement=Database::getInstance()->getConnexion()->prepare('select * from question where numQuiz=:id;');
        $statement->execute(['id'=>$this->getId()]);
        while ($row = $statement->fetch()) {
           $question = new Question(id:$row['id'],text:$row['text']);
           $question->setQuiz($this);
           $liste[]=$question;
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
    public static function update(Quizz $quiz)
    {
        $statement = Database::getInstance()->getConnexion()->prepare('UPDATE quiz set title=:title WHERE id =:id');
        $statement->execute(['title'=>$quiz->getTitle(),'id'=>$quiz->getId()]);
    }
    public static function delete(Quizz $quiz)
    {
        $statement = Database::getInstance()->getConnexion()->prepare('DELETE FROM quiz WHERE id =:id');
        $statement->execute(['id'=>$quiz->getId()]);
    }

}