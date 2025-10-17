<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ResponseData extends Data
{

    // Formato para las respuestas de la API
    public function __construct(
        public string $message,
        public mixed $data = null,
        public ?int $code = null,
    ) {}
}
