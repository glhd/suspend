<?php

namespace Glhd\Suspend;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Traits\ForwardsCalls;
use JsonSerializable;
use RuntimeException;
use function transducers\comp as compose;
use function transducers\filter;
use function transducers\map;
use function transducers\transduce;
use Traversable;

class DeferredCollection implements Enumerable
{
	use ForwardsCalls;
	use ForwardsToEnumerable;
	
	protected $source;
	
	protected ?Enumerable $collection = null;
	
	protected array $operations = [];
	
	protected Collection $initial;
	
	/**
	 * @param array|Enumerable|Arrayable|Jsonable|JsonSerializable|Traversable $source
	 */
	public function __construct($source, Collection $initial = null)
	{
		$this->source = $source;
		$this->initial = $initial ?? new Collection();
	}
	
	public function execute(): Enumerable
	{
		if (null === $this->collection) {
			$reducer = compose(...$this->operations);
			$this->collection = transduce($reducer, $this->step(), $this->source, $this->initial);
			$this->operations = [];
		}
		
		return $this->collection;
	}
	
	public function map(callable $callback): self
	{
		return $this->addOperation(map($callback));
	}
	
	public function filter(callable $callback = null): self
	{
		return $this->addOperation(filter($callback));
	}
	
	public function thread($name, $callback): ParallelOperations
	{
		return ParallelOperations::makeWithThread($this, $name, $callback);
	}
	
	public function addOperation(callable $operation): self
	{
		$this->throwIfAlreadyExecuted();
		
		$this->operations[] = $operation;
		
		return $this;
	}
	
	protected function step(): array
	{
		return [
			'init' => function() {
				return new Collection();
			},
			'result' => 'transducers\identity',
			'step' => function(Collection $result, $input) {
				return $result->push($input);
			},
		];
	}
	
	protected function throwIfAlreadyExecuted(): void
	{
		if (null !== $this->collection) {
			throw new RuntimeException('You cannot add additional operations after a deferred collection is already executed.');
		}
	}
}
