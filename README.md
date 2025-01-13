# Nova Field Default Filter Macro

[![Latest Version on Packagist](https://img.shields.io/packagist/v/javii-script/default-value-filterable.svg?style=flat-square)](https://packagist.org/packages/javii-script/default-value-filterable)
[![Total Downloads](https://img.shields.io/packagist/dt/javii-script/default-value-filterable.svg?style=flat-square)](https://packagist.org/packages/javii-script/default-value-filterable)

Nova Field Default Filter Macro is a custom macro for **Laravel Nova** that simplifies the process of setting default values and enabling filtering capabilities for fields.

---

## Features

- **Default Value for Filters:** Easily set default values for fields when filters are applied.
- **Customizable Filtering Logic:** Define how the filtering is applied with custom callback functions.
- **Seamless Integration:** Designed specifically for Laravel Nova resources.

---

## Screenshot

![Nova Field Default Filter Macro Example](https://raw.githubusercontent.com/JaviiScript/default-value-filterable/main/docs/user-resource.png)

---

## Requirements

To use this package, ensure your environment meets the following requirements:

- PHP: `^8.1`
- Laravel Nova: `^5.0`

---

## Installation

Install the package via Composer:

```bash
composer require javii-script/default-value-filterable
```

## Usage
The defaultFilterable macro makes it easy to define a default value for filters, enhancing the functionality of your Nova resources.

## Basic Example

```php
Text::make('Name')
    ->defaultFilterable(function () {
        return 'John Doe';
    }),
```

In this example, the Name field will have a default filter value of John Doe.

## Advanced Example with Custom Filtering Logic

```php
Text::make('Name')
    ->defaultFilterable(function () {
        return 'John Doe';
    }, function ($request, $query, $value, $attribute) {
        $query->where($attribute, 'LIKE', "{$value}%");
    }),
```

In this example:

1. **Default Value:** The Name field will default to John Doe when filtering.
2. **Custom Filtering:** The filtering logic will apply a LIKE clause to match records where the Name starts with the filter value.

## Contributing

Contributions are welcome! If you have ideas for improvements or find any issues, feel free to open an issue or submit a pull request.

## License

This package is open-sourced software licensed under the MIT license.

## Links

- [Packagist](https://packagist.org/packages/javii-script/default-value-filterable)
- [GitHub Repository](https://github.com/JaviiScript/default-value-filterable)