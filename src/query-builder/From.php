<?php

namespace QueryBuilder;

use QueryBuilder\Join\Equals;

class From
{
    public function __construct(private string $expression)
    {
    }
    
    public function join(string $table, Equals $condition )
    {
        $this->expression .= PHP_EOL . Query::INDENT . 'JOIN ' . $table . ' ON ' . (string) $condition;
    }

    public function __toString()
    {
        return 'FROM ' . $this->expression;
    }
}