<?php

namespace QueryBuilder;

class Column
{
    public function __construct(
        private string $expression,
        private ?string $alias = null
    ) {
    }

    public function __toString()
    {
        if ($this->alias) {
            return $this->expression . ' AS ' . $this->alias;
        }
        return $this->expression;
    }
}