<?php
declare(strict_types=1);
namespace app\quizz\controller;
use app\quizz\model\Quizz;

class ApiController extends BaseController
{
    public function index()
    {
        $this->addParam('message',"Salut");
        $this->view('api/index');
    }
    public function quiz($id,$name)
    {
        $this->addParam('liste',Quizz::list());
        $this->view('api/liste_quiz');
    }
}
