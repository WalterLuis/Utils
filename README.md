# Utils
Utilities and tools for everyday use 🐱‍👤

[![Software License](https://img.shields.io/github/license/walterluis/utils?style=for-the-badge)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/walterluis/utils?style=for-the-badge)](CHANGELOG.md)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/walterluis/utils?style=for-the-badge)

## Installation

Via Composer

``` bash
$ composer require WalterLuis/Utils
```

## Usage
``` php
require_once './vendor/autoload.php';

use WalterLuis\Utils\Validator;

$foo = 'Hello';

if (Validator::string($foo)) {
    $foo .= ' world!';
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
