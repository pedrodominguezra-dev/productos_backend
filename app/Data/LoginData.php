<?php

namespace App\Data;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\StringType;

use Spatie\LaravelData\Data;

class LoginData extends Data
{

    #[Required, Email]
    public string $email;

    #[Required, StringType]
    public string $password;
}
