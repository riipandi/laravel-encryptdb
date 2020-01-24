# Laravel EncryptDB

[![Build Status](https://travis-ci.org/riipandi/laravel-encryptdb.svg?branch=master)](https://travis-ci.org/riipandi/laravel-encryptdb)
[![StyleCI](https://github.styleci.io/repos/236050770/shield?branch=master)](https://github.styleci.io/repos/236050770)
[![Latest Stable Version](http://img.shields.io/packagist/v/riipandi/laravel-encryptdb.svg?style=flat)](https://packagist.org/packages/riipandi/laravel-encryptdb)
[![Total Downloads](http://img.shields.io/packagist/dt/riipandi/laravel-encryptdb.svg?style=flat)](https://packagist.org/packages/riipandi/laravel-encryptdb)

Encrypt/decrypt stored records in database using eloquent.

## Quick Start

### Installation

```sh
composer require riipandi/laravel-encryptdb
```

### Usage

1. Use the  trait in your model: `use Riipandi\LaravelEncryptDb\Traits\HasEncryptable`
2. Define a protected `$encryptedFields` array containing a list of the encrypted attributes.

```php
<?php

namespace App;

use Riipandi\LaravelEncryptDb\Traits\HasEncryptable;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasEncryptable;

    protected $encryptedFields = [
        'card_number',
        'cvv_code',
    ];
}
```

## License

Copyright 2020 - Aris Ripandi

Licensed under the [Apache License][choosealicense], Version 2.0 (the "License"); you may not use this
file except in compliance with the License. You may obtain a copy of the License at:
<http://www.apache.org/licenses/LICENSE-2.0>

Unless required by applicable law or agreed to in writing, software distributed under
the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF
ANY KIND, either express or implied. See the License for the specific language
governing permissions and limitations under the License.

[choosealicense]:https://choosealicense.com/licenses/apache-2.0/
