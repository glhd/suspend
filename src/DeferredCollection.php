<?php

namespace Glhd\Suspend;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Traits\ForwardsCalls;
use JsonSerializable;
use RuntimeException;
use Traversable;

class DeferredCollection implements Enumerable
{
	use ForwardsCalls;
	use ForwardsToEnumerable;
	
	protected $source;
	
	protected ?Enumerable $collection = null;
	
	protected array $operations = [];
	
	protected ?Closure $step = null;
	
	protected OperationFactory $factory;
	
	protected Collection $initial;
	
	/**
	 * @param array|Enumerable|Arrayable|Jsonable|JsonSerializable|Traversable $source
	 */
	public function __construct($source, ?callable $step = null, Collection $initial = null, OperationFactory $factory = null)
	{
		$this->factory = $factory ?? app(OperationFactory::class);
		
		$this->source = $source;
		$this->step = null === $step
			? $this->factory->toCollection()
			: Closure::fromCallable($step);
		$this->initial = $initial ?? new Collection();
	}
	
	public function execute(): Enumerable
	{
		if (null === $this->collection) {
			$reducer = $this->factory->compose(...$this->operations);
			$this->collection = collect($this->source)->reduce($reducer($this->step), $this->initial);
			$this->operations = [];
		}
		
		return $this->collection;
	}
	
	public function map(callable $callback): self
	{
		return $this->addOperation($this->factory->map($callback));
	}
	
	public function filter(callable $callback = null): self
	{
		return $this->addOperation($this->factory->filter($callback));
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
	
	protected function throwIfAlreadyExecuted(): void
	{
		if (null !== $this->collection) {
			throw new RuntimeException('You cannot add additional operations after a deferred collection is already executed.');
		}
	}
}
