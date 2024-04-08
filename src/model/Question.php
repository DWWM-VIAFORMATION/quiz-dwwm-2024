<?php
declare(strict_types=1);
namespace app\quizz\model;
class Question
{
    private string $_text;
    private int $_id;
    public function __construct(string $text,int $id=0) {
        $this->_id=$id;
        $this->_text = $text;
    }
}