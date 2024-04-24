<?php

namespace QueryBuilder;

class Sum extends Column
{
    public function __construct(
        private string $expression,
        private ?string $alias = null
    ) {
        $this->expression = 'SUM(' . $this->expression . ')';
    }

    public function __toString()
    {
        if ($this->alias) {
            return $this->expression . ' AS ' . $this->alias;
        }
        return $this->expression;
    }
}