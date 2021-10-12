<?php

namespace Glhd\Suspend;

use Closure;
use Illuminate\Support\Collection;

class OperationFactory
{
	public function compose(callable ...$callbacks): Closure
	{
		return static fn(callable $initial) => collect($callbacks)
			->reduce(static fn($result, $next) => $next($result), $initial);
	}
	
	public function filter(callable $predicate): Closure
	{
		return static fn(callable $step) => static fn($carry, $item) => $predicate($item)
			? $step($carry, $item)
			: $carry;
	}
	
	public function map(callable $mutation): Closure
	{
		return static fn(callable $step) => static fn($carry, $item) => $step($carry, $mutation($item));
	}
	
	public function identity(): Closure
	{
		return static fn(callable $step) => static fn($carry, $item) => $step($carry, $item);
	}
	
	public function toCollection(): Closure
	{
		return static fn(Collection $collection, $item) => $collection->push($item);
	}
}
