<?php

namespace App\Tests\Util;

use App\Util\Calculator;
use App\Exception\DivisionByZero;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testSum()
    {
        $leftTerm = 12;
        $rightTerm = 17;

        $result = Calculator::sum($leftTerm, $rightTerm);

        $this->assertEquals($leftTerm + $rightTerm, $result);
    }

    public function testSubstraction()
    {
        $leftTerm = 25;
        $rightTerm = 10;

        $result = Calculator::substraction($leftTerm, $rightTerm);

        $this->assertEquals($leftTerm - $rightTerm, $result);
    }

    public function testMultiplication()
    {
        $leftFactor = 2;
        $rightFactor = 2.5;

        $result = Calculator::multiplication($leftFactor, $rightFactor);

        $this->assertEquals($leftFactor * $rightFactor, $result);
    }

    public function testDivision()
    {
        $dividend = 30;
        $divisor = 10;

        $result = Calculator::division($dividend, $divisor);

        $this->assertEquals($dividend / $divisor, $result);
    }

    public function testIfWeCantDiviseBy0()
    {
        $dividend = 12;
        $divisor = 0;

        try {
            Calculator::division($dividend, $divisor);
            $this->fail('Exception not raised');
        } catch (\Exception $e) {
            $this->assertInstanceOf(DivisionByZero::class, $e);
        }        
    }
}