<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function register(Request $request)
    {

        $data = $request->all();
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'dept_id' => ['required'],
            'phone' => ['required', 'string', 'max:255'],
        ];
        $avatar = null;
        if ($request->avatar instanceof UploadedFile) {
            $avatar = $request->avatar->store('avatar', 'public');
            $data['avatar'] = $avatar;
        }else{
            unset($data['avatar']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $register = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);
        $employee = Employee::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'dept_id' => $request->dept_id,
            'user_id' => $register->id,
            'avatar' => $avatar

        ]);
        if ($register) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'Success',
                    'message' => 'Registered'
                ],
                'data' => [
                    'employee' => $employee,
                ],
            ]);
        } else {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'Failed',
                    'message' => 'Registration failed'
                ],
            ], 200);
        }
    }
}
