<?php

namespace App\Services;

use App\Data\ProductData;
use App\Data\ResponseData;
use App\Data\SearchData;
use App\Models\Product;
use Error;
use Throwable;

class ProductService
{

    public function getProducts(SearchData $searchData)
    {

        try {
            $products = Product::search($searchData->search)->paginate(
                perPage: $searchData->perPage,
                page: ($searchData->page),
            );
            
            return new ResponseData(
                message: 'Productos obtenidos correctamente',
                data: $products,
                code: 200,
                status: true
            );
        } catch (Throwable $e) {
            return new ResponseData(
                message: 'Hubo un error inesperado al buscar los productos: ' . $e->getMessage(),
                code: 500,
                status: false
            );
        }
    }
}
