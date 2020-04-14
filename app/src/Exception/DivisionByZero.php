<?php

namespace App\Exception;

class DivisionByZero extends \Exception
{
    protected $message = 'Division by zero';
}