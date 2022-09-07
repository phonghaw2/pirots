<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    use ResponseTrait;
    private object $model;

    public function __construct()
    {
        $this->model = Product::query();
    }
    public function show(Request $request): JsonResponse
    {
        $id = $request->id;
        $product = $this->model
            ->with('category:id,name')
            ->findOrFail($id);
        return $this->successResponse($product);
    }
}
