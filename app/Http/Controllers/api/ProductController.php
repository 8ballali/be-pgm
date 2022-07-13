<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
class ProductController extends Controller
{
    public function index()
    {
        $product = Product::where('status', 'Available')->get();
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data Product'
            ],
            'data' => [
                'product' => $product
            ]
        ],200);

    }

}
