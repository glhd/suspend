<?php

test('basic mapping and filtering', function() {
	$result = suspend([1, 2, 3, 4])
		->filter(fn($value) => 0 === $value % 2)
		->map(fn($value) => $value * 10)
		->filter(fn($value) => $value === 40)
		->map(fn($value) => $value * 10)
		->toArray();
	
	expect($result)->toEqual([400]);
});

test('it only calls operations once per item', function() {
	$calls = 0;
	
	suspend([1, 2, 3, 4])
		->filter(function($value) use (&$calls) {
			$calls++;
			return 0 === $value % 2;
		})
		->map(function($value) use (&$calls) {
			$calls++;
			return $value * 10;
		})
		->map(function($value) use (&$calls) {
			$calls++;
			return $value + 1;
		})
		->toArray();
	
	expect($calls)->toBe(8);
});
