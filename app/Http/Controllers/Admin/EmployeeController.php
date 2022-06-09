<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departemen;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function store(Request $request)
    {

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

        $user = User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => "EMPLOYEE",

        ]);
        $select_user = User::where('email', $request['email'])->first();

        $employee = Employee::create([
            'name' => $request['name'],
            'avatar' => $file,
            'address' => $request['address'],
            'phone' => $request['phone'],
            'dept_id' => $request['dept_id'],
            'user_id' => $select_user->id
        ]);
        if ($employee) {
            return redirect()->back();
        }
    }

    public function index()
    {
        $user = User::where('role_id', '2');
        $employee = Employee::get();
        $department = Department::all();
        $logged = Auth::user();
        // dd($logged);
        return view('employee.index', compact('employee', 'user', 'department', ));
        return view('layouts.app', compact('employee', 'user', 'department', 'logged'));

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
        $user = User::all();
        $employee = Employee::where($user_id, 'user_id')->delete();
        return redirect('/employee');
    }
}
