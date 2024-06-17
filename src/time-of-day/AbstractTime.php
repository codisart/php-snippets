<?php

namespace TimeOfDay;

abstract class AbstractTime
{
    const MILLISECONDS_IN_A_DAY = 24 * 60 * 60 * 1000;
    const MILLISECONDS_IN_A_HOUR = 60 * 60 * 1000;
    const MILLISECONDS_IN_A_MINUTE = 60 * 1000;

    protected int $counter;

    public static function fromParts(
        int $hours,
        ?int $minutes = 0,
        ?int $seconds = 0,
        ?int $milliseconds = 0
    ) {
        match(true) {
            (0 > $hours || $hours > 23)  => throw new \ValueError('Hour is not valid'),
            (0 > $minutes || $minutes > 59) => throw new \ValueError('Minute is not valid'),
            (0 > $seconds || $seconds > 59)  => throw new \ValueError('Second is not valid'),
            (0 > $milliseconds || $milliseconds > 999) => throw new \ValueError('Millisecond is not valid'),
            default => 'Everything is ok'
        };

        return new static(
            $hours * self::MILLISECONDS_IN_A_HOUR
            + $minutes * self::MILLISECONDS_IN_A_MINUTE
            + $seconds * 1000
            + $milliseconds
        );
    }

    protected function hours(): int
    {
        return intdiv($this->counter, self::MILLISECONDS_IN_A_HOUR);
    }

    protected function minutes(): int
    {
        $rest = $this->counter % self::MILLISECONDS_IN_A_HOUR;
        return intdiv($rest, self::MILLISECONDS_IN_A_MINUTE);
    }
    
    protected function seconds(): int
    {
        $rest = $this->counter % self::MILLISECONDS_IN_A_MINUTE;
        return intdiv($rest, 1000);
    }
    
    protected function milliseconds(): int
    {
        return $this->counter % 1000;
    }
}