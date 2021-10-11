<?php

namespace Glhd\Suspend\Tests;

use Glhd\Suspend\Support\SuspendServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
	protected function getPackageProviders($app)
	{
		return [
			SuspendServiceProvider::class,
		];
	}
	
	protected function getPackageAliases($app)
	{
		return [];
	}
	
	protected function getApplicationTimezone($app)
	{
		return 'America/New_York';
	}
}
