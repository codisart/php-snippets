<?php

namespace TimeOfDay;

class Duration extends AbstractTime
{
    public function __construct(int $counter)
    {
        if (0 > $counter) {
            throw new \ValueError('Milliseconds should be a positive integer');
        }
        $this->counter = $counter;
    }
    
    public function equals(Duration $other): bool
    {
        return $this->counter === $other->counter;
    }
    
    public function isGreater(Duration $other): bool
    {
        return $this->counter > $other->counter;
    }
    
    public function isLess(Duration $other): bool
    {
        return $this->counter < $other->counter;
    }
}