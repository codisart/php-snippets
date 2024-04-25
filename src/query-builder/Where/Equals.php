<?php

namespace QueryBuilder\Where;

use QueryBuilder\Column;
use QueryBuilder\Where;

class Equals extends Where
{
    public function __construct(private Column $left, private string $right)
    {
    }

    public function __toString(): string
    {
        return $this->left . ' = ' . $this->right;
    }
}

