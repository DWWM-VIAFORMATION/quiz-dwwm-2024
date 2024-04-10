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
$quizz = new Quizz('Un super quiz de MALADE OUF timbre');
Quizz::createDB($quizz );
var_dump(Quizz::list());
echo "YOLOOO<hr>";
$lesquiztimbres = Quizz::filter('MALADE OUF');
foreach ($lesquiztimbres as $key => $quiztobemodified) {
    $quiztobemodified->setTitle('Un tres bon quiz');
    Quizz::update($quiztobemodified);
}
var_dump(Quizz::list());
echo "YOLOOO<hr>";
$lesquiztimbres = Quizz::filter('timbre');
foreach ($lesquiztimbres as $key => $quiztobedeleted) {
    Quizz::delete($quiztobedeleted);
}
var_dump(Quizz::list());
echo "YOLOOO<hr>";
$question = new Question('Quelle est la marque de la trott du formateur?');
$quizz = Quizz::findById(1);
$question->setQuiz($quizz);
$question->persist();
foreach (Quizz::list() as $key => $quiz) {
    echo "<h1>".$quiz->getTitle()."</h1><ul>";
    foreach ($quiz->getQuestions() as $key => $question) {
        echo "<li>".$question->getText()."</li>";
        
    }
    echo "</ul>";
}

