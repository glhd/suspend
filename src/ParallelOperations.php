<?php

namespace Glhd\Suspend;

class ParallelOperations
{
	protected array $threads = [];
	
	public static function makeWithThread($source, $name, $callback): self
	{
		return (new static($source))->thread($name, $callback);
	}
	
	public function thread($name, callable $callback = null): self
	{
		if (null === $callback && is_callable($name)) {
			$callback = $name;
			$name = count($this->threads) - 1;
		}
		
		$this->threads[$name] = $callback;
		
		return $this;
	}
}
