<?php
declare(strict_types=1);
use app\quizz\model\Question;
use app\quizz\model\QuestionCollection;
use app\quizz\model\Quizz;
use app\quizz\model\ReponseCollection;
require_once dirname(__DIR__) .'/vendor/autoload.php';
echo "SALUT";
// var_dump($_SERVER);
// var_dump($_GET);
try
{
    // $connexion = new PDO('mysql:host=mysql-srv;dbname=quizz','db_user','password');
    // $statement=$connexion->prepare('select * from quiz;');
    // $statement->execute();
    // while ($row = $statement->fetch()) {
    //     print_r($row);
    // }
    // $liste = Quizz::list();
    // var_dump($liste);
}
catch (PDOException $e)
{
    echo "error:".$e->getMessage();
}
// echo "YOLOOO<br>";
// var_dump(Quizz::findById(1));
// echo "YOLOOO<br>";
// var_dump(Quizz::filter('quizz'));
// echo "YOLOOO<br>";
// var_dump(Quizz::filter('toto'));
// echo "YOLOOO<hr>";
// var_dump(QuestionCollection::getQuestions(1));
// echo "YOLOOO<hr>";
// var_dump(ReponseCollection::getReponses(1));
Quizz::createDB(new Quizz('Un super quiz de MALADE OUF'));
var_dump(Quizz::list());