<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::first();
        $response = [
            'success' => true,
            'message' => 'Data Kategori',
            'data' => new CategoryResource($category)
        ];
        return response()->json($response, Response::HTTP_OK);

    }
    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Kategori',
                'data' => $category
            ],200);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Data Not Found',
                'data' => []
            ],404);;
        }
    }
    public function add(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name'=> 'required',
            'dept_id'=> 'required',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $category = Category::create($data);
        $response = [
            'success'      => true,
            'message'    => 'Data Kategori Created',
            'data'      => $category,
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }
    public function update(Request $request, Category $category)
    {
        $data = $request->all();
        $rules = [
            'name'         => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $category->update($data);
        $response = [
            'success'   => true,
            'message'   => 'Data Kategori Updated',
            'data'      => $category,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function delete($id)
    {
        $department = Category::findOrFail($id);

        try {
            $department->delete();
            $response = [
                'success' => true,
                'message' => 'Data Department Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);

        } catch (QueryException $e ) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
