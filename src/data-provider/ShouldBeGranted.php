<?php declare(strict_types=1);

namespace DataProvider;

#[\Attribute(\Attribute::TARGET_CLASS|\Attribute::IS_REPEATABLE)]
class ShouldBeGranted
{
    public function __construct(
        public readonly string $role
    )
    {

    }
}