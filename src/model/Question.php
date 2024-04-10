<?php
declare(strict_types=1);
namespace app\quizz\model;
class Question
{
    private string $_text;
    private int $_id;
    private Quizz $_quiz;
    public function __construct(string $text,int $id=0) {
        $this->_id=$id;
        $this->_text = $text;
    }
    public function getQuiz():Quizz
    {
        return $this->_quiz;
    }
    public function setQuiz(Quizz $quiz)
    {
        $this->_quiz = $quiz;
        $quiz->addQuestion($this);
    }
    public function getText():string
    {
        return $this->_text;
    }
    /** CREATE */
    public function persist()
    {
        $statement= Database::getInstance()->getConnexion()->prepare('INSERT INTO question (text,numQuiz) values (:text,:numQuiz)');
        $statement->execute(['text'=>$this->_text,'numQuiz'=>$this->getQuiz()->getId()]);
    }
}