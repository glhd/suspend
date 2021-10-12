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
