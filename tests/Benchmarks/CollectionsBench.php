<?php

namespace Glhd\Suspend\Tests\Benchmarks;

use Generator;
use Glhd\Suspend\DeferredCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

class CollectionsBench
{
	/** @ParamProviders({"provideImplementations"}) */
	public function bench_filter_map_small_datased(array $params)
	{
		[$source, $suspend] = $params;
		$this->getCollection(100, $source, $suspend)
			->filter(fn($number) => 0 === $number % 2)
			->map(fn($number) => $number * 10)
			->filter(fn($number) => $number > 100)
			->map(fn($number) => Str::contains("$number", ['2', '3', '4']))
			->toArray();
	}
	
	/** @ParamProviders({"provideImplementations"}) */
	public function bench_filter_map_medium_datased(array $params)
	{
		[$source, $suspend] = $params;
		$this->getCollection(1000, $source, $suspend)
			->filter(fn($number) => 0 === $number % 2)
			->map(fn($number) => $number * 10)
			->filter(fn($number) => $number > 100)
			->map(fn($number) => Str::contains("$number", ['2', '3', '4']))
			->toArray();
	}
	
	/** @ParamProviders({"provideImplementations"}) */
	public function bench_filter_map_large_datased(array $params)
	{
		[$source, $suspend] = $params;
		$this->getCollection(10000, $source, $suspend)
			->filter(fn($number) => 0 === $number % 2)
			->map(fn($number) => $number * 10)
			->filter(fn($number) => $number > 100)
			->map(fn($number) => Str::contains("$number", ['2', '3', '4']))
			->toArray();
	}
	
	public function provideImplementations(): Generator
	{
		foreach ([Collection::class, LazyCollection::class] as $source) {
			foreach ([false, true] as $suspend) {
				$label = class_basename($source);
				$label .= $suspend
					? ' (suspend)'
					: ' (base)';
				
				yield $label => [$source, $suspend];
			}
		}
	}
	
	protected function getCollection($count, $source, $suspend): Enumerable
	{
		$collection = $source::range(1, $count);
		
		if ($suspend) {
			$collection = new DeferredCollection($collection);
		}
		
		return $collection;
	}
}
