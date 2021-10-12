<?php

namespace Glhd\Suspend;

use Closure;
use Illuminate\Support\Collection;

class OperationFactory
{
	public function compose(callable ...$callbacks): Closure
	{
		$callbacks = array_reverse($callbacks);
		
		return static function($result) use ($callbacks) {
			foreach ($callbacks as $callback) {
				$result = $callback($result);
			}
			
			return $result;
		};
	}
	
	public function filter(callable $predicate): Closure
	{
		return static function(callable $step) use ($predicate) {
			return static function($carry, $item) use ($predicate, $step) {
				return $predicate($item)
					? $step($carry, $item)
					: $carry;
			};
		};
	}
	
	public function map(callable $mutation): Closure
	{
		return static function(callable $step) use ($mutation) {
			return static function($carry, $item) use ($step, $mutation) {
				return $step($carry, $mutation($item));
			};
		};
	}
	
	public function identity(): Closure
	{
		return static function(callable $step) {
			return static function($carry, $item) use ($step) {
				return $step($carry, $item);
			};
		};
	}
	
	public function toCollection(): Closure
	{
		return static function(Collection $collection, $item) {
			return $collection->push($item);
		};
	}
}
