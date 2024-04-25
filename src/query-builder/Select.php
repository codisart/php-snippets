<?php

namespace QueryBuilder;

class Select
{
    private array $columns;
    
    public function __construct(Column ...$columns)
    {
        $this->columns = $columns;
    }
    
    public function add(Column $column){
        $this->columns[] = $column;
        return $this;
    }

    public function __toString()
    {
        $select = implode("," . PHP_EOL . Query::INDENT, $this->columns);
        return "SELECT" . PHP_EOL . Query::INDENT . $select;
    }
}