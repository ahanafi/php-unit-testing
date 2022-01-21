<?php

use App\Calculator\Addition;
use App\Calculator\Exceptions\NoOperandException;
use PHPUnit\Framework\TestCase;

class AdditionTest extends TestCase
{

    /** @test */
    public function addsUpGivenOperands(): void
    {
        $addition = new Addition();
        $addition->setOperands([5, 10]);

        self::assertEquals(15, $addition->calculate());
    }

    /** @test */
    public function noOperandsGivenThrowsExceptionWhenCalculating(): void
    {
        $this->expectException(NoOperandException::class);

        $addition = new Addition();
        $addition->calculate();
    }

}