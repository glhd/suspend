<?php

namespace Glhd\Suspend;

use Illuminate\Support\Arr;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\ForwardsCalls;

trait ForwardsToEnumerable
{
	use ForwardsCalls;
	
	public static function make($items = [])
	{
		return new static($items);
	}
	
	public static function wrap($value)
	{
		return $value instanceof Enumerable
			? new static($value)
			: new static(Arr::wrap($value));
	}
	
	public static function unwrap($value)
	{
		return $value instanceof Enumerable
			? $value->all()
			: $value;
	}
	
	public static function empty()
	{
		return new static([]);
	}
	
	public static function times($number, callable $callback = null)
	{
		if ($number < 1) {
			return new static();
		}
		
		return static::range(1, $number)
			->when($callback)
			->map($callback);
	}
	
	public static function range($from, $to)
	{
		return new static(range($from, $to));
	}
	
	public static function proxy($method)
	{
		// FIXME
		throw new \RuntimeException(__CLASS__.'::proxy() is not yet supported.');
	}
	
	public function toArray()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function getIterator()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function count()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function all()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function average($callback = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function median($key = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function mode($key = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function collapse()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function some($key, $operator = null, $value = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function containsStrict($key, $value = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function avg($callback = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function contains($key, $operator = null, $value = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function crossJoin(...$lists)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function dd(...$args)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function dump()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function diff($items)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function diffUsing($items, callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function diffAssoc($items)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function diffAssocUsing($items, callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function diffKeys($items)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function diffKeysUsing($items, callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function duplicates($callback = null, $strict = false)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function duplicatesStrict($callback = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function each(callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function eachSpread(callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function every($key, $operator = null, $value = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function except($keys)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function when($value, callable $callback, callable $default = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whenEmpty(callable $callback, callable $default = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whenNotEmpty(callable $callback, callable $default = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function unless($value, callable $callback, callable $default = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function unlessEmpty(callable $callback, callable $default = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function unlessNotEmpty(callable $callback, callable $default = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function where($key, $operator = null, $value = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whereNull($key = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whereNotNull($key = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whereStrict($key, $value)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whereIn($key, $values, $strict = false)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whereInStrict($key, $values)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whereBetween($key, $values)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whereNotBetween($key, $values)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whereNotIn($key, $values, $strict = false)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whereNotInStrict($key, $values)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function whereInstanceOf($type)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function first(callable $callback = null, $default = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function firstWhere($key, $operator = null, $value = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function flatten($depth = INF)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function flip()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function get($key, $default = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function groupBy($groupBy, $preserveKeys = false)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function keyBy($keyBy)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function has($key)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function implode($value, $glue = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function intersect($items)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function intersectByKeys($items)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function isEmpty()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function isNotEmpty()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function join($glue, $finalGlue = '')
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function keys()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function last(callable $callback = null, $default = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function mapSpread(callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function mapToDictionary(callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function mapToGroups(callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function mapWithKeys(callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function flatMap(callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function mapInto($class)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function merge($items)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function mergeRecursive($items)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function combine($values)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function union($items)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function min($callback = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function max($callback = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function nth($step, $offset = 0)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function only($keys)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function forPage($page, $perPage)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function partition($key, $operator = null, $value = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function concat($source)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function random($number = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function reduce(callable $callback, $initial = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function replace($items)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function replaceRecursive($items)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function reverse()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function search($value, $strict = false)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function shuffle($seed = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function skip($count)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function skipUntil($value)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function skipWhile($value)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function slice($offset, $length = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function split($numberOfGroups)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function chunk($size)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function chunkWhile(callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function sort($callback = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function sortDesc($options = SORT_REGULAR)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function sortBy($callback, $options = SORT_REGULAR, $descending = false)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function sortByDesc($callback, $options = SORT_REGULAR)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function sortKeys($options = SORT_REGULAR, $descending = false)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function sortKeysDesc($options = SORT_REGULAR)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function sum($callback = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function take($limit)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function takeUntil($value)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function takeWhile($value)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function tap(callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function pipe(callable $callback)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function pluck($value, $key = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function reject($callback = true)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function unique($key = null, $strict = false)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function uniqueStrict($key = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function values()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function pad($size, $value)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function countBy($callback = null)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function zip($items)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function collect()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function __toString()
	{
		return (string) $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function __get($key)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function toJson($options = 0)
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	public function jsonSerialize()
	{
		return $this->executeAndForward(Str::after(__METHOD__, '::'), func_get_args());
	}
	
	protected function executeAndForward($method, $arguments)
	{
		return $this->forwardCallTo($this->execute(), $method, $arguments);
	}
}
