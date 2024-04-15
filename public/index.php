<?php
declare(strict_types=1);
use app\quizz\router\HttpRequest;
use app\quizz\router\Router;

require_once dirname(__DIR__) .'/vendor/autoload.php';

try
	{
		$httpRequest = new HttpRequest();
        $router = new Router();
        $httpRequest->setRoute($router->findRoute($httpRequest));
        $httpRequest->getRoute()->run();
	}
	catch(Exception $e)
	{
        echo "Une erreur s'est produite";
        echo $e->getMessage();
	}