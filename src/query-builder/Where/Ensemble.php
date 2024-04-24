<?php

namespace QueryBuilder\Where;

use QueryBuilder\Column;
use QueryBuilder\Where;

class Ensemble extends Where
{
    public function __construct(private string $expression)
    {
    }

    public function __toString(): string
    {
        return $this->expression;
    }
}

