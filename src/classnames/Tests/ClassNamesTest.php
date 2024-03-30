<?php
declare(strict_types=1);

namespace ClassNames\Tests;

use ClassNames\ClassNames;
use function ClassNames\classnames;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class ClassNamesTest extends TestCase
{
    public static function providerClassNames()
    {
        return [
            ['solid large', ['solid' => true, 'red' => false, 'large' => true]],
            ['solid large', 'solid', 'large'],
            ['solid large', 'solid', ['large' => true]],
            ['solid large', ['solid' => true], ['large' => true]],
        ];
    }

    #[Test]
    #[DataProvider('providerClassNames')]
    public function classNames($expected, ...$params): void
    {
        $result = ClassNames::from(...$params);

        self::assertSame($expected, $result);
    }

    #[Test]
    #[DataProvider('providerClassNames')]
    public function classNamesAsFunction($expected, ...$params): void
    {
        $result = classnames(...$params);
    
        self::assertSame($expected, (string) $result);
    }
}