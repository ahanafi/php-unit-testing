<?php

use App\Calculator\Addition;
use App\Calculator\Calculator;
use App\Calculator\Division;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /** @test */
    public function canSetSingleOperation(): void
    {
        $addition = new Addition();
        $addition->setOperands([5, 10]);

        $calculator = new Calculator();
        $calculator->setOperation($addition);

        self::assertCount(1, $calculator->getOperations());
    }

    /** @test */
    public function canSetMultipleOperations(): void
    {
        $addition1 = new Addition();
        $addition1->setOperands([5, 10]);

        $addition2 = new Addition();
        $addition2->setOperands([2, 2]);

        $calculator = new Calculator();
        $calculator->setOperations([$addition1, $addition2]);

        self::assertCount(2, $calculator->getOperations());
    }

    /** @test */
    public function operationsAreIgnoredIfNotInstanceOfOperationInterface(): void
    {
        $addition = new Addition();
        $addition->setOperands([5, 10]);

        $calculator = new Calculator();
        $calculator->setOperations([$addition, 'one', 'two']);

        self::assertCount(1, $calculator->getOperations());
    }

    /** @test */
    public function canCalculateResult(): void
    {
        $addition = new Addition();
        $addition->setOperands([5, 10]);

        $calculator = new Calculator();
        $calculator->setOperation($addition);

        self::assertEquals(15, $calculator->calculate());
    }

    /** @test */
    public function calculateMethodReturnsMultipleResults(): void
    {
        $addition = new Addition();
        $addition->setOperands([5, 10]); // 15

        $division = new Division();
        $division->setOperands([50, 2]); // 25

        $calculator = new Calculator();
        $calculator->setOperations([$addition, $division]);

        self::assertIsArray($calculator->calculate());
        self::assertEquals(15, $calculator->calculate()[0]);
        self::assertEquals(25, $calculator->calculate()[1]);
    }
}