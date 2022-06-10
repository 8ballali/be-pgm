<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departemen;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'dept_id' => ['required'],
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
            'dept_id' => $request->nik,
            'user_id' => $register->id,
            'avatar' => $avatar,

        ]);
        if ($register) {
            return response()->json([
                'success' =>true,
                'message' => 'Registrasi Berhasil',
                'data' => $employee
            ], 201);
        } else {
            return response()->json([
                'success' =>false,
                'message' => 'Registrasi Gagal',

            ], 200);
        }


    }

    public function index()
    {
        // $user = User::where('role_id', '2');

        $employee = Employee::get();
        $department = Department::all();
        $logged_in = Auth::id();
        if (Auth::user()->role_id == 1) {
            $roles = Auth::user()->roles->name;
            $name = $roles;
        }else {
            $employee_name = Employee::where('user_id', $logged_in)->select('name')->get();
            $name = $employee_name[0]->name;
        }
        return view('employee.index', compact('employee', 'department', 'name'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'dept_id' => 'required|integer',
        ]);
        if ($request->avatar) {
            $avatar = $request->file('avatar');
            $avatarName = $avatar->getClientOriginalName();
            $getExt = $avatar->getClientOriginalExtension();
            $fileName = "AVA" . date('YdmYdmYhis') . "." . $getExt;
            $avatar->move('avatar/', $fileName);
            $file = $fileName;
        } else {
            $file = null;
        }
        $employee = Employee::find($id);
        $employee->name = $request['name'];
        $employee->address = $request['address'];
        $employee->phone = $request['phone'];
        $employee->dept_id = $request['dept_id'];
        $employee->save();
        $user = User::find($employee->user_id);
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->save();
        return redirect()->back();
    }
    public function delete($user_id)
    {
        $user = User::findOrFail($user_id);
        // dd($user, $user->employee) ;
        $user->employee->delete();
        $user->delete();
        return redirect('/employee');
    }
    // public function test($user_id)
    // {
    //     $user = User::findOrFail($user_id);
    //     dd($user, $user->employee) ;
    // }
}
