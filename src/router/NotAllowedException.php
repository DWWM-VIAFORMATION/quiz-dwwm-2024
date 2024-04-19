<?php
# src/router/NotAllowedException.php
declare(strict_types=1);
namespace app\quizz\router;
class NotAllowedException extends  \Exception
{
    public function __construct($message = "Not Allowed here")
        {
            parent::__construct($message, 403);
        }
}
