<?php declare(strict_types=1);

namespace DataProvider\Tests;

use DataProvider\ShouldBeGranted;
use ReflectionClass;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public static function fetchRoles()
    {
        $reflectionClass = new ReflectionClass(static::class);
        $attributes = $reflectionClass->getAttributes(ShouldBeGranted::class);
        foreach ($attributes as $attribute) {
            yield [$attribute->newInstance()->role];
        }
    }
}