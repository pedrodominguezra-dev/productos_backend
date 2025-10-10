<?php

namespace App\Http\Controllers\Api;

use App\Data\ProductData;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParamsTableRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductController extends Controller
{

    public function __construct(
        protected ProductService $productService
    ) {}

    public function index(ParamsTableRequest $request)
    {
        try {
            $search = $request->input('search', '') ?? '';
            $offset = $request->input('offset', 0) ?? 0;
            $limit = $request->input('limit', 10) ?? 10;
            $results = $this->productService->getProducts(
                $search,
                $offset,
                $limit
            );

            return response()->json([
                'total' => $results['total'],
                'products' => $results['products']
            ]);
        } catch (Throwable $e) {
            Log::error('Error al obtener los productos ' . $e->getMessage());
            return response()->json([
                'error' => 'Ha sucedido un error inesperado al obtener los productos',
                'development' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
