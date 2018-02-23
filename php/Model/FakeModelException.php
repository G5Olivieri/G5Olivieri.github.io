<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 23/02/2018
 * Time: 18:04
 */

namespace Project\Model;


use Throwable;

class FakeModelException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}