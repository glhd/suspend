<?php

namespace Glhd\Suspend\Tests;

class DeferredCollectionTest extends TestCase
{
	public function test_it_applies_basic_mapping_and_filtering_operations(): void
	{
		$result = suspend([1, 2, 3, 4])
			->filter(fn($value) => 0 === $value % 2)
			->map(fn($value) => $value * 10)
			->toArray();
		
		$this->assertSame([20, 40], $result);
	}
}
