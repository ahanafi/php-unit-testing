<?php

namespace App\Calculator;

abstract class OperationAbstract
{
    protected array $operands = array();

    public function setOperands(array $operands): void
    {
        $this->operands = $operands;
    }
}