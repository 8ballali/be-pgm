<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::all();
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
        return view('admin.department', compact('department', 'employee', 'name'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Department::create([
            'name' => $request->name,
        ]);
        toast('Your Post has been submited!','success');
        return redirect('/department');
    }
    public function update(Request $request, $id){
        $department = Department::find($id);
        $department->name = $request->input('name');
        $department->save();
        toast('Department  has been Updated!','success');
        return redirect('/department');
    }
    public function destroy($id){
        $department = Department::findOrFail($id);
        $department->delete();
        toast('Department has been Deleted!','success');
        return redirect('/department');
    }
}
