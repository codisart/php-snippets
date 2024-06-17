<?php declare(strict_types=1);

namespace DataProvider\Tests;

use DataProvider\ShouldBeGranted;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\TestWith;

#[ShouldBeGranted('ROLE_LIST')]
#[ShouldBeGranted('ROLE_ADMIN')]
class PatateTest extends TestCase
{
    #[DataProvider('fetchRoles')]
    public function testRoleIsOK($role)
    {
        self::assertSame('ROLE_LIST', $role);
    }
}