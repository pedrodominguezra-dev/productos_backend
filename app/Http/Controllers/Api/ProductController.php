<?php

namespace App\Http\Controllers\Api;

use App\Data\ProductData;
use App\Data\ResponseData;
use App\Data\SearchData;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParamsTableRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductController extends Controller
{

    // Controlador para la gestión de productos
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index(ParamsTableRequest $request, SearchData $searchData)
    {

        $response = $this->productService->getProducts($searchData);

        return response()->json([
            'message' => $response->message,
            'data' => $response->data,
            'status' => $response->status,
        ], $response->code);
    }
}
