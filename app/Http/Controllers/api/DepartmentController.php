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
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data Department'
            ],
            'data' => [
                'department' => $department
            ]
        ],200);

    }


}
