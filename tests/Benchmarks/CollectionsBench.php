<?php

namespace Glhd\Suspend\Tests\Benchmarks;

use Generator;
use Glhd\Suspend\DeferredCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;
use function transducers\comp as compose;
use function transducers\filter;
use function transducers\map;
use function transducers\transduce;

class CollectionsBench
{
	public function bench_iterating_models_base()
	{
		$this->getModels(10000)
			->filter(fn(Model $model) => $model->id % 2 === 0)
			->filter(fn(Model $model) => Str::contains($model->name, ['1', '2', '3']))
			->filter(fn(Model $model) => Str::contains($model->email, ['2', '3', '4']))
			->map(fn(Model $model) => $model->setAttribute('email', strtolower($model->email)))
			->map(fn(Model $model) => "{$model->name} <{$model->email}>")
			->toArray();
	}
	
	public function bench_iterating_models_suspend()
	{
		DeferredCollection::make($this->getModels(10000))
			->filter(fn(Model $model) => $model->id % 2 === 0)
			->filter(fn(Model $model) => Str::contains($model->name, ['1', '2', '3']))
			->filter(fn(Model $model) => Str::contains($model->email, ['2', '3', '4']))
			->map(fn(Model $model) => $model->setAttribute('email', strtolower($model->email)))
			->map(fn(Model $model) => "{$model->name} <{$model->email}>")
			->toArray();
	}
	
	/** @ParamProviders({"provideImplementations"}) */
	public function bench_filter_map_small_dataset(array $params)
	{
		[$source, $suspend] = $params;
		$this->getCollection(100, $source, $suspend)
			->filter(fn($number) => 0 === $number % 2)
			->map(fn($number) => $number * 10)
			->filter(fn($number) => $number > 100)
			->toArray();
	}
	
	/** @ParamProviders({"provideImplementations"}) */
	public function bench_filter_map_medium_dataset(array $params)
	{
		[$source, $suspend] = $params;
		$this->getCollection(1000, $source, $suspend)
			->filter(fn($number) => 0 === $number % 2)
			->map(fn($number) => $number * 10)
			->filter(fn($number) => $number > 100)
			->toArray();
	}
	
	/** @ParamProviders({"provideImplementations"}) */
	public function bench_filter_map_large_dataset(array $params)
	{
		[$source, $suspend] = $params;
		$this->getCollection(10000, $source, $suspend)
			->filter(fn($number) => 0 === $number % 2)
			->map(fn($number) => $number * 10)
			->filter(fn($number) => $number > 100)
			->toArray();
	}
	
	public function bench_foreach_loop()
	{
		$source = LazyCollection::range(1, 10000);
		$result = new Collection();
		
		foreach ($source as $number) {
			if (0 === $number % 2) {
				continue;
			}
			
			$number = $number * 10;
			
			if ($number <= 100) {
				continue;
			}
			
			$result->push($number);
		}
		
		$result->toArray();
	}
	
	public function bench_mtdowling_transducers_package()
	{
		$xf = compose(
			filter(fn($number) => 0 === $number % 2),
			map(fn($number) => $number * 10),
			filter(fn($number) => $number > 100)
		);
		
		$step = [
			'init' => function() {
				return new Collection();
			},
			'result' => 'Transducers\identity',
			'step' => function($result, $input) {
				return $result->push($input);
			},
		];
		
		transduce($xf, $step, LazyCollection::range(1, 10000))->toArray();
	}
	
	public function provideImplementations(): Generator
	{
		foreach ([Collection::class, LazyCollection::class] as $source) {
			foreach ([false, true] as $suspend) {
				$label = class_basename($source);
				$label .= $suspend
					? ' (suspend)'
					: ' (base)';
				
				yield $label => [$source, $suspend];
			}
		}
	}
	
	protected function getCollection($count, $source, $suspend): Enumerable
	{
		$collection = $source::range(1, $count);
		
		if ($suspend) {
			$collection = new DeferredCollection($collection);
		}
		
		return $collection;
	}
	
	protected function getModels($count = 1000): LazyCollection
	{
		return new LazyCollection(static function() use ($count) {
			for ($i = 0; $i < $count; $i++) {
				$attributes = [
					'id' => $i,
					'name' => "Chris #{$i}",
					'email' => "chris-{$i}@mailinator.com",
				];
				
				yield new class($attributes) extends Model {
					protected $guarded = [];
				};
			}
		});
	}
}
