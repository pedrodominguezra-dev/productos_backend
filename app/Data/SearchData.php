<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class SearchData extends Data
{

    // Formato para los datos de búsqueda
    public function __construct(
        public ?string $search = '',
        public ?int $perPage = 10,
        public ?int $page = 1,
    ) {}
}
