<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function index()
    {
        $category = Category::with('department')->get();
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
        return view('admin.category', compact('category','employee','department', 'name'));

    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'dept_id' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
            'dept_id' => $request->dept_id,
        ]);
        toast('Your Category as been submited!','success');
        return redirect('/categories');
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->dept_id = $request->input('dept_id');
        $category->save();
        toast('Category Updated!','success');
        return redirect('/categories');
    }

    public function destroy ($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('/categories');
    }
}
