<?php

namespace Glhd\Suspend\Support\Facades;

use Glhd\Suspend\OperationFactory;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Closure filter(callable $predicate)
 * @method static \Closure map(callable $mutation)
 * @method static \Closure identity()
 * @method static \Closure toCollection()
 *
 * @see OperationFactory
 */
class Operation extends Facade
{
	protected static function getFacadeAccessor(): string
	{
		return OperationFactory::class;
	}
}
