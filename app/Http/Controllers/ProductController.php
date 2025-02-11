<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    function index () {
        try{
            return $this->productService->getAllProducts();
        } catch (\Exception $exception){
            return response()->json([
                'message' => 'Getting products data failed!',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    function get($productId){
        try{
            return $this->productService->getProductById($productId);
        } catch (\Exception $exception){
            return response()->json([
                'message' => 'Getting product data failed!',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
