<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class SearchData extends Data
{

    // Formato para los datos de búsqueda
    public function __construct(
        public ?string $query = '',
        public ?int $offset = 0,
        public ?int $limit = 10,
    ) {}
}
