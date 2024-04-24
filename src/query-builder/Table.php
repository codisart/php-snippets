<?php

namespace QueryBuilder;

class Table
{
    public function __construct(protected string $name, private ?string $alias = null)
    {
    }
    
    public function from() {
        return new From($this->alias ? $this->name . ' ' . $this->alias : $this->name);
    }
    
    public function column(string $expression, ?string $alias = null)
    {
        $table = $this->alias ?? $this->name;
        return new Column($table . '.' . $expression, $alias);
    }
    
    public function sum(string $expression, ?string $as = null)
    {
        $table = $this->alias ?? $this->name;
        return new Sum($table . '.' . $expression, $as);
    }

    public function __toString()
    {
        return $this->alias ?? $this->name;
    }
}