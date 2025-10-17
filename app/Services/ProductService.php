<?php

namespace App\Services;

use App\Data\ProductData;
use App\Data\ResponseData;
use App\Data\SearchData;
use App\Models\Product;
use Throwable;

class ProductService
{

    public function getProducts(SearchData $searchData)
    {

        try {
            $products = Product::search($searchData->query)->paginate(
                perPage: $searchData->limit,
                page: ($searchData->offset / $searchData->limit) + 1,
            );

            return new ResponseData(
                message: 'Productos obtenidos correctamente',
                data: $products,
                code: 200
            );
        } catch (Throwable $e) {
            return new ResponseData(
                message: 'Error al buscar los productos: ' . $e->getMessage(),
                code: 500
            );
        }
    }
}
