<?php

namespace App\Calculator;

use App\Calculator\Exceptions\NoOperandException;

class Addition extends OperationAbstract implements OperationInterface
{
    public function calculate()
    {
        if (count($this->operands) === 0) {
            throw new NoOperandException("Please provide operands!");
        }

        return array_sum($this->operands);
    }
}