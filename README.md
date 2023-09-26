# Nova Field Default Filter Macro

[![Latest Version on Packagist](https://img.shields.io/packagist/v/javii-script/default-value-filterable.svg?style=flat-square)](https://packagist.org/packages/javii-script/default-value-filterable)
[![Total Downloads](https://img.shields.io/packagist/dt/javii-script/default-value-filterable.svg?style=flat-square)](https://packagist.org/packages/javii-script/default-value-filterable)

![screenshot 1](https://raw.githubusercontent.com/JaviiScript/default-value-filterable/main/docs/user-resource.png)

Nova Field Default Filter Macro is a custom macro for Laravel Nova that simplifies the process of setting default values and enabling filtering capabilities for fields.

## Requirements

- `"php": "^7.3|^8.0"`
- `"laravel/nova": "^4.0"`

## Installation

You can install this package via Composer:

```bash
composer require javii-script/default-value-filterable
```

## Usage
To use this macro, simply call the defaultFilterable method on a Nova field. Here's an example of how to use it

```php
use Laravel\Nova\Fields\Field;

Field::macro('defaultFilterable', function ($callback, callable $filterableCallback = null) {
    $this->withMeta(['defaultValueCallback' => $callback]);
    $this->filterable($filterableCallback);
    return $this;
});
```

This macro makes it easy to define a default value for the filter, enhancing the functionality of your Nova resource.

## Example

```php
Text::make('Name')
    ->defaultFilterable(function () {
        return 'John Doe';
    })
    ->sortable(),
```

In this example, the 'Name' field will have a default value of 'John Doe' when filtering is applied.

```php
Text::make('Name')
    ->defaultFilterable(function () {
        return 'John Doe';
    }, function ($request, $query, $value, $attribute) {
        $query->where($attribute, 'LIKE', "{$value}%");
    })
    ->sortable(),
```

Additionally, the second argument is a callback function that allows you to customize how the filtering is applied.