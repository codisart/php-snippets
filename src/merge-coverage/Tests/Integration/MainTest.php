<?php
declare(strict_types=1);

namespace MergeCoverage\Tests\Integration;

use PHPUnit\Framework\TestCase;
use MergeCoverage\Main;

#[CoversClass(Codisart\MergeCoverage\Main::class)]
class MainTest extends TestCase
{

    public function testMultiply() {
        $main = new Main();

        self::assertEquals(1, $main->multiply());
        self::assertEquals(1, $main->multiply(1));
        self::assertEquals(2, $main->multiply(1,2));
    }
}