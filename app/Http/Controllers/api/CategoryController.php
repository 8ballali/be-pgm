<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::with('department')->get();
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data Category',
            ],
            'data' => [
                //This is How to get Data Resources for HasMany Relationship
                'category' =>  CategoryResource::collection($category)
            ]
        ],200);
    }
    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Detail Data Category'
                ],
                'data' => [
                    'category' => $category
                ],
            ],200);
        }else {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'status' => 'Failed',
                    'message' => 'Data Not Found'
                ],
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
        return response()->json([
            'meta' => [
                'code' => 201,
                'status' => 'success',
                'message' => 'Data Category was Successfully Created'
            ],
            'data' => [
                'category' => $category
            ]
        ],200);

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
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data Category updated successfully'
            ],
            'data' => [
                'category' => $category
            ]
        ],200);
    }
    public function delete($id)
    {
        $department = Category::findOrFail($id);

        try {
            $department->delete();
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Deleted successfully'
                ]
            ],200);
        } catch (QueryException $e ) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
