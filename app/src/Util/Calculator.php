<?php

namespace App\Util;

use App\Exception\DivisionByZero;

class Calculator
{
    public static function sum(float $leftTerm, float $rightTerm): float
    {
        return $leftTerm + $rightTerm;
    }

    public static function substraction(float $leftTerm, float $rightTerm): float
    {
        return $leftTerm - $rightTerm;
    }

    public static function multiplication(float $leftFactor, float $rightFactor): float
    {
        return $leftFactor * $rightFactor;
    }

    public static function division(float $dividend, float $divisor): float
    {
        if ($divisor === 0.0) {
            throw new DivisionByZero();
        }

        return $dividend / $divisor;
    }
}