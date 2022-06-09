<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::all();
        return view('admin.department.index', compact('department'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Department::create([
            'name' => $request->name,
        ]);
        return redirect('/pertamina/list-spbu');
    }
}
