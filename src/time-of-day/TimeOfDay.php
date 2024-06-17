<?php

namespace TimeOfDay;

class TimeOfDay extends AbstractTime
{
    public function __construct(int $milliseconds)
    {
        $rest = $milliseconds % self::MILLISECONDS_IN_A_DAY;
        $this->counter = $rest + (0 > $rest ? self::MILLISECONDS_IN_A_DAY : 0);
    }
    
    public function passedSince(TimeOfDay $other)
    {
        return new Duration($this->counter - $other->counter);
    }
    
    public function was(Duration $duration): TimeOfDay
    {
        return new self($this->counter - $duration->counter);
    }
    
    public function willBe(Duration $duration): TimeOfDay
    {
        return new self($this->counter + $duration->counter);
    }
    
    public function equals(TimeOfDay $other): bool
    {
        return $this->counter === $other->counter;
    }
    
    public function isBefore(TimeOfDay $other): bool
    {
        return $this->counter < $other->counter;
    }

    public function isAfter(TimeOfDay $other): bool
    {
        return $this->counter > $other->counter;
    }

    public function format(string $format): string
    {
        return $this->onDay(new \DateTimeImmutable())->format($format);
    }
    
    public function onDay(\DateTimeImmutable $day): \DateTimeImmutable
    {
        return ($day)->setTime(
            $this->hours(),
            $this->minutes(),
            $this->seconds(),
            $this->milliseconds(),
        );
    }
}