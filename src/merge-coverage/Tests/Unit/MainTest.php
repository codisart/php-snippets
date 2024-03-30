<?php
declare(strict_types=1);

namespace MergeCoverage\Tests\Unit;

use PHPUnit\Framework\TestCase;
use MergeCoverage\Main;

#[CoversClass(Codisart\MergeCoverage\Main::class)]
class MainTest extends TestCase
{
    
    public function testAdd() {
        $main = new Main();
        
        self::assertEquals(0, $main->add());
        self::assertEquals(1, $main->add(1));
        self::assertEquals(3, $main->add(1,2));
    }
}