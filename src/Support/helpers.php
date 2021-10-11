<?php

use Glhd\Suspend\DeferredCollection;

if (!function_exists('suspend')) { // @codeCoverageIgnore
	function suspend($value = null): DeferredCollection
	{
		return new DeferredCollection($value);
	}
}
