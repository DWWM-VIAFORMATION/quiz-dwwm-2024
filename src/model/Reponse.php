<?php
declare(strict_types=1);
namespace app\quizz\model;
class Reponse
{
    private string $_text;
    private int $_id;
    private bool $_isValid;
    public function __construct(string $text,int $id=0, bool $isValid=false) {
        $this->_id=$id;
        $this->_text = $text;
        $this->_isValid= $isValid;
    }
}