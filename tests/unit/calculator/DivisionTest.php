<?php

use App\Calculator\Division;
use App\Calculator\Exceptions\NoOperandException;
use PHPUnit\Framework\TestCase;

class DivisionTest extends TestCase
{

    /** @test */
    public function dividesGivenOperands(): void
    {
        $division = new Division();
        $division->setOperands([100, 2]);

        self::assertEquals(50, $division->calculate());
    }

    /** @test */
    public function noOperandsGivenThrowsExceptionWhenCalculating(): void
    {
        $this->expectException(NoOperandException::class);

        $division = new Division();
        $division->calculate();
    }

    /** @test */
    public function removeDivisionByZeroOperands(): void
    {
        $division = new Division();
        $division->setOperands([10, 0, 0, 5, 0]);

        self::assertEquals(2, $division->calculate());
    }
}