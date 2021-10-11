<?php

namespace Glhd\Suspend;

class ParallelOperations
{
	public static function makeWithThread($source, $name, $callback): self
	{
		return (new static($source))->thread($name, $callback);
	}
	
	public function thread(): self
	{
		return $this;
	}
}
