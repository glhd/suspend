<?php

namespace Glhd\Suspend\Support;

use Glhd\Suspend\OperationFactory;
use Illuminate\Support\ServiceProvider;

class SuspendServiceProvider extends ServiceProvider
{
	protected string $base_dir;
	
	public function __construct($app)
	{
		parent::__construct($app);
		
		$this->base_dir = dirname(__DIR__, 2);
	}
	
	public function register()
	{
		$this->app->singleton(OperationFactory::class);
		
		$this->mergeConfigFrom("{$this->base_dir}/config.php", 'suspend');
	}
	
	public function boot()
	{
		require_once __DIR__.'/helpers.php';
		
		$this->bootConfig();
	}
	
	protected function bootConfig(): self
	{
		if (method_exists($this->app, 'configPath')) {
			$this->publishes([
				"{$this->base_dir}/config.php" => $this->app->configPath('suspend.php'),
			], 'suspend-config');
		}
		
		return $this;
	}
}
