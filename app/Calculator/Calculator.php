<?php

namespace App\Calculator;

class Calculator
{
    protected array $operations = array();

    /**
     * @param mixed $operation
     */
    public function setOperation(OperationInterface $operation): void
    {
        $this->operations[] = $operation;
    }

    public function setOperations(array $operations): void
    {
        // Filter operations
        $filteredOperations = array_filter($operations, function ($operation) {
            return $operation instanceof OperationInterface;
        });

        $this->operations = array_merge($this->operations, $filteredOperations);
    }

    /**
     * @return array
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    public function calculate(): array
    {
        if(count($this->operations) > 1 ) {
            return array_map(function ($operation) {
                return $operation->calculate();
            }, $this->operations);
        }

        return $this->operations[0]->calculate();
    }
}