<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\StringType;

use Spatie\LaravelData\Data;

class LoginData extends Data
{

    // Formato para los datos de login
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
