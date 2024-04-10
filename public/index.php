<?php
declare(strict_types=1);
use app\quizz\model\Quizz;

require_once dirname(__DIR__) .'/vendor/autoload.php';
echo "SALUT";
$lesQuizz= Quizz::list();
if (count($lesQuizz)==0)
{
    echo "<p> chargemement du quiz depuis json";
    $json = json_decode(file_get_contents('quizlist.json'));
    Quizz::loadFromJson($json);
    $lesQuizz= Quizz::list();
}
foreach (Quizz::list() as $key => $quiz) {
    echo "<H1>".$quiz->getTitle();
    echo "<UL>";
    foreach ($quiz->getQuestions() as $key => $question) {
        echo "<li>".$question->getText()."</li>";
        echo "<OL>";
        foreach ($question->getReponses() as $key => $reponse) {
            $color=$reponse->getIsValid()==true?"green":"red";
            echo "<li style='color:".$color."'>".$reponse->getText()."</li>";
        }
        echo "</OL>";
    }
    echo "</UL>";
}