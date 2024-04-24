<?php


namespace QueryBuilder;

use QueryBuilder\Where\Ensemble;

class Where
{
    public function __construct(private string $expression)
    {
    }

    public static function atLeastOne(self ...$wheres): self {
        foreach ($wheres as &$where) {
            if ($where instanceof Ensemble) {
                $where = '(' . $where . ')';
            }
        }
        return new Ensemble(implode(' OR ', $wheres));
    }

    public static function everyOnes(self ...$wheres): self {
        foreach ($wheres as &$where) {
            if ($where instanceof Ensemble) {
                $where = '(' . $where . ')';
            }
        }
        return new Ensemble(implode(' AND ', $wheres));
    }
    
    public function __toString(): string
    {
        return $this->expression;
    }
}
