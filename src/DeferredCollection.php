<?php

namespace Glhd\Suspend;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Traits\ForwardsCalls;

class DeferredCollection implements Enumerable
{
	use ForwardsCalls;
	use ForwardsToEnumerable;
	
	protected $source;
	
	protected ?Enumerable $collection = null;
	
	protected array $operations = [];
	
	protected ?Closure $step = null;
	
	protected OperationFactory $factory;
	
	public function __construct($source, OperationFactory $factory = null)
	{
		$this->source = $source;
		$this->factory = $factory ?? app(OperationFactory::class);
	}
	
	public function execute()
	{
		if (null === $this->collection) {
			$reducer = app(OperationFactory::class)->compose(...array_reverse($this->operations));
			$this->collection = collect($this->source)->reduce($reducer($this->getStep()), new Collection());
			$this->operations = [];
		}
		
		return $this->collection;
	}
	
	public function map(callable $callback)
	{
		$this->operations[] = $this->factory->map($callback);
		
		return $this;
	}
	
	public function filter(callable $callback = null)
	{
		$this->operations[] = $this->factory->filter($callback);
		
		return $this;
	}
	
	public function thread($name, $callback): ParallelOperations
	{
		return ParallelOperations::makeWithThread($this, $name, $callback);
	}
	
	public function getStep(): callable
	{
		return $this->step ?? app(OperationFactory::class)->toCollection();
	}
}
