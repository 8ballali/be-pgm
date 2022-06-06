<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::all();
        $response = [
            'success' => true,
            'message' => 'Data Department',
            'data' => $department
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function show($id)
    {
        $department = Department::find($id);
        if ($department) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Department',
                'data' => $department
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
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $department = Department::create($data);
        $response = [
            'success'      => true,
            'message'    => 'Data Department Created',
            'data'      => $department,
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }

    public function update(Request $request, Department $department)
    {
        $data = $request->all();
        $rules = [
            'name'         => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $department->update($data);
        $response = [
            'success'   => true,
            'message'   => 'Data Department Updated',
            'data'      => $department,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function delete($id)
    {
        $department = Department::findOrFail($id);

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
