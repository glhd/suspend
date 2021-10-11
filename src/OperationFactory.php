<?php

namespace Glhd\Suspend;

use Closure;
use Illuminate\Support\Collection;

class OperationFactory
{
	public function compose(callable ...$callback): Closure
	{
		return static fn($initial) => collect($callback)->reduce(fn($result, $callback) => $callback($result), $initial);
	}
	
	public function filter(callable $predicate): Closure
	{
		return static fn($step) => static fn($carry, $item) => $predicate($item)
			? $step($carry, $item)
			: $carry;
	}
	
	public function map(callable $mutation): Closure
	{
		return static fn($step) => static fn($carry, $item) => $step($carry, $mutation($item));
	}
	
	public function identity(): Closure
	{
		return static fn($step) => static fn($carry, $item) => $step($carry, $item);
	}
	
	public function toCollection(): Closure
	{
		return static fn(Collection $collection, $item) => $collection->push($item);
	}
}
