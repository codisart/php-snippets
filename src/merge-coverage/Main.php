<?php
declare(strict_types=1);

namespace MergeCoverage;

class Main
{
    public function add(int ...$operands) {
        if (count($operands) === 0) {
            return 0;
        }
        return array_sum($operands);
    }
    
    public function multiply(int ...$operands) {
        if (count($operands) === 0) {
            return 1;
        }
        $result = 1;
        foreach($operands as $operand){
            $result *= $operand;
        }
        return $result;
    }
}