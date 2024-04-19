<?php
declare(strict_types=1);
namespace app\quizz\controller;
use app\quizz\model\Quizz;

class HomeController extends BaseController
{
    public function index()
    {
        $this->view('home/index');
    }
    public function homepage()
    {
        $this->view('home/index_connected');
    }
    
}
