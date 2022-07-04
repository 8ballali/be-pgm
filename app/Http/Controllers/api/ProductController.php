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
        $product = Product::all();
        $response = [
            'success' => true,
            'message' => 'Data Department',
            'data' => $product
        ];
        return response()->json($response, Response::HTTP_OK);
    }

}
