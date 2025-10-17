<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ProductData extends Data
{
    // Formato para los datos de producto
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public float $price,
    ) {}
}
