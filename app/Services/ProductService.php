<?php

namespace App\Services;

use App\Data\ProductData;
use App\Models\Product;

class ProductService
{

    public function getProducts(?string $search = null, ?int $offset = 0, ?int $limit = 10)
    {
        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $total = $query->count();
        $products = $query->skip($offset)->take($limit)->get();

        $products = $products->map(fn($product) => $this->transform($product));
        return compact('total', 'products');
    }

    public function transform(Product $product): ProductData
    {
        return ProductData::from($product);
    }
}
