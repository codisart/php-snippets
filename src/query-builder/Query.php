<?php

namespace QueryBuilder;

class Query
{
    const INDENT = "    ";

    const FINAL_SEMI_COLON = ";" . PHP_EOL;

    private $select;
    private $from;
    private $where;

    public function __construct(Select $select, From $from, Where $where)
    {
        $this->select = $select;
        $this->from   = $from;
        $this->where  = $where;
    }

    public function __toString()
    {
        $parts = [
            $this->select,
            $this->from,
            "WHERE " . $this->where,
            Query::FINAL_SEMI_COLON,
        ];

        return implode(PHP_EOL, $parts);
    }
}

