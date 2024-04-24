<?php

namespace QueryBuilder;

class Join
{
    public function __construct(private string $table)
    {
        $this->table = $table;
    }

    private function plop($from, $join) {
        
    }

    public function __toString()
    {
        return Query::INDENT . "JOIN " . $this->table . $this->conditions();
    }
}