<?php
declare(strict_types=1);

namespace TimeOfDay\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use TimeOfDay\Duration;
use TimeOfDay\TimeOfDay;

class DurationTest extends TestCase
{
    #[Test]
    public function fromParts(): void
    {
        $result = Duration::fromParts(12);
        $expected = new Duration(12 * 60 * 60 * 1000);
        self::assertEquals($expected, $result);

        $result = Duration::fromParts(12,34);
        $expected = new Duration(12 * 60 * 60 * 1000 + 34 * 60 * 1000);
        self::assertEquals($expected, $result);

        $result = Duration::fromParts(12, 34 , 56 );
        $expected = new Duration(12 * 60 * 60 * 1000 + 34 * 60 * 1000 + 56 * 1000);
        self::assertEquals($expected, $result);

        $result = Duration::fromParts(0);
        $expected = new Duration(0);
        self::assertEquals($expected, $result);
    }

    #[Test]
    public function hourNotValidTooBig(): void
    {
        self::expectException(\ValueError::class);
        self::expectExceptionMessage('Hour is not valid');
        Duration::fromParts(24);
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
    public function comparison(): void
    {
        $foo = Duration::fromParts(12, 34 , 56);
        $bar = Duration::fromParts(12);

        self::assertTrue($foo->isGreater($bar));
        self::assertTrue($bar->isLess($foo));
    }

    #[Test]
    public function equalsComparison(): void
    {
        $foo = Duration::fromParts(12, 34 , 0);
        $bar = Duration::fromParts(12, 34);
    
        self::assertTrue($foo->equals($bar));
    }

    #[Test]
    public function equalsComparisonBetweenChildrenObjects(): void
    {
        $foo = Duration::fromParts(12, 34 , 0);
        $bar = TimeOfDay::fromParts(12, 34);

        self::expectException(\TypeError::class);
        self::assertTrue($foo->equals($bar));
    }
}