<div style="float: right;">
	<a href="https://github.com/glhd/suspend/actions" target="_blank">
		<img 
			src="https://github.com/glhd/suspend/workflows/Pest/badge.svg" 
			alt="Test Status" 
		/>
	</a>
	<a href="https://codeclimate.com/github/glhd/suspend/test_coverage" target="_blank">
		<img 
			src="https://api.codeclimate.com/v1/badges/f597a6e8d9f968a55f03/test_coverage" 
			alt="Coverage Status" 
		/>
	</a>
	<a href="https://packagist.org/packages/glhd/suspend" target="_blank">
        <img 
            src="https://poser.pugx.org/glhd/suspend/v/stable" 
            alt="Latest Stable Release" 
        />
	</a>
	<a href="./LICENSE" target="_blank">
        <img 
            src="https://poser.pugx.org/glhd/suspend/license" 
            alt="MIT Licensed" 
        />
    </a>
    <a href="https://twitter.com/inxilpro" target="_blank">
        <img 
            src="https://img.shields.io/twitter/follow/inxilpro?style=social" 
            alt="Follow @inxilpro on Twitter" 
        />
    </a>
    <a href="https://twitter.com/DCoulbourne" target="_blank">
        <img 
            src="https://img.shields.io/twitter/follow/DCoulbourne?style=social" 
            alt="Follow @DCoulbourne on Twitter" 
        />
    </a>
</div>

# Suspend

Suspend lets you perform an unlimited number of operations on your data in a single pass.
Double or triple your collections performance for free.

## Installation

## Usage

```php
suspend($data)
    ->filter(/* ... */)
    ->filter(/* ... */)
    ->map(/* ... */)
    ->map(/* ... */)
    ->toArray(); // <-- All operations are suspended until you need the data
```
