<?php

namespace QueryBuilder\Join;

use QueryBuilder\Column;

class Equals
{
    public function __construct(private Column $left, private Column $right)
    {
    }
    
    public function __toString()
    {
        return $this->left . ' = ' . $this->right;
    }
}