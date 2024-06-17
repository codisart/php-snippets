<?php
declare(strict_types=1);

namespace TimeOfDay\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use TimeOfDay\TimeOfDay;
use TimeOfDay\Duration;

class TimeOfDayTest extends TestCase
{
    #[Test]
    public function timeOfDay(): void
    {
        $result = new TimeOfDay(45296000);
        $expected = new \DateTimeImmutable('2000-01-01 12:34:56');
        
        self::assertSame($expected->format('H:i:s'), $result->format('H:i:s'));
    }

    #[Test]
    public function plop(): void
    {
        $time = new TimeOfDay(45296000);
        $result = $time->onDay(new \DateTimeImmutable('2000-01-01'));
    
        $expected = new \DateTimeImmutable('2000-01-01 12:34:56');
    
        self::assertEquals($expected, $result);
    }

    #[Test]
    public function negativeMilliseconds(): void
    {
        $result = new TimeOfDay(-45296000);
        self::assertEquals(new TimeOfDay(41104000), $result);

        $result = new TimeOfDay(-131696000);
        self::assertEquals(new TimeOfDay(41104000), $result);
    }

    #[Test]
    public function comparison(): void
    {
        $foo = TimeOfDay::fromParts(12, 34 , 56);
        $bar = TimeOfDay::fromParts(12);

        self::assertTrue($foo->isAfter($bar));
        self::assertTrue($bar->isBefore($foo));
    }
    
    #[Test]
    public function equalsComparison(): void
    {
        $foo = TimeOfDay::fromParts(12, 34 , 0);
        $bar = TimeOfDay::fromParts(12, 34);
    
        self::assertTrue($foo->equals($bar));
    }
    
    #[Test]
    public function fromParts(): void
    {
        $result = TimeOfDay::fromParts(12);
        $expected = new TimeOfDay(12 * 60 * 60 * 1000);
        self::assertEquals($expected, $result);

        $result = TimeOfDay::fromParts(12,34);
        $expected = new TimeOfDay(12 * 60 * 60 * 1000 + 34 * 60 * 1000);
        self::assertEquals($expected, $result);

        $result = TimeOfDay::fromParts(12, 34 , 56 );
        $expected = new TimeOfDay(12 * 60 * 60 * 1000 + 34 * 60 * 1000 + 56 * 1000);
        self::assertEquals($expected, $result);

        $result = TimeOfDay::fromParts(0);
        $expected = new TimeOfDay(0);
        self::assertEquals($expected, $result);
    }

    #[Test]
    public function hourNotValidTooBig(): void
    {
        self::expectException(\ValueError::class);
        self::expectExceptionMessage('Hour is not valid');
        TimeOfDay::fromParts(24);
    }
    
    #[Test]
    public function hourNotValidTooSmall(): void
    {
        self::expectException(\ValueError::class);
        self::expectExceptionMessage('Hour is not valid');
        TimeOfDay::fromParts(-3);
    }

    #[Test]
    public function minuteNotValid(): void
    {
        self::expectException(\ValueError::class);
        self::expectExceptionMessage('Minute is not valid');
        TimeOfDay::fromParts(12, 60);
    }

    #[Test]
    public function secondNotValid(): void
    {
        self::expectException(\ValueError::class);
        self::expectExceptionMessage('Second is not valid');
        TimeOfDay::fromParts(12, 34 , 60);
    }
    
    #[Test]
    public function passedSince(): void
    {
        $time = new TimeOfDay(45296000);
        $duration = $time->passedSince(new TimeOfDay(44296000));
        
        self::assertEquals(new Duration(1000000), $duration);
    }

    #[Test]
    public function was(): void
    {
        $time = new TimeOfDay(45296000);
        $was = $time->was(new Duration(1000000));
    
        self::assertEquals(new TimeOfDay(44296000), $was);
    }

    #[Test]
    public function willBe(): void
    {
        $time = new TimeOfDay(45296000);
        $was = $time->willBe(new Duration(1000000));
    
        self::assertEquals(new TimeOfDay(46296000), $was);
    }
}
