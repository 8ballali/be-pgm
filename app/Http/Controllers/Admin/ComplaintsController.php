<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ComplaintsController extends Controller
{
    public function index()
    {
        $department = Department::all();
        $customer = Customer::all();
        $logged_in = Auth::id();

        $employee = Employee::where('user_id',auth()->user()->id)->first();

        //ngambil departemen si employee
        $department = Department::find($employee->dept_id);

        // ngambil kategorinya, mumpung sama2 pake depart_id. Asumsi 1 departemen banyak kategori
        $category = Category::where('dept_id',$employee->dept_id)->get();

        // ngambil komplain berdasarkan id nya categories
        $complaints = Complaint::whereIn('category_id',$category->modelKeys())->get();
        if ($complaints == null){
            $complaints = '';
        };

        if (Auth::user()->role_id == 1) {
            $roles = Auth::user()->roles->name;
            $name = $roles;
        }else {
            $employee_name = Employee::where('user_id', $logged_in)->select('name','dept_id')->get();
            // dd($employee_name);
            $name = $employee_name[0]->name;
        }
        return view('admin.complaint', compact('department','customer', 'name', 'complaints', 'category'));
    }
    public function update($id,Request $request)
    {
        $data = $request->all();
        $rules = [
            'status' => 'required',
        ];
        $this->validate($request, [
        ]);
        $complaints = Complaint::find($id);
        if (request()->hasFile('tindak_lanjut')) {
            $tindak_lanjut = request()->file('tindak_lanjut')->store('tindak_lanjut', 'public');
            if (Storage::disk('public')->exists($complaints->tindak_lanjut)) {
                Storage::disk('public')->delete([$complaints->tindak_lanjut]);
            }
            $tindak_lanjut = request()->file('tindak_lanjut')->store('tindak_lanjut', 'public');
            $data['tindak_lanjut'] = $tindak_lanjut;
            $complaints->update($data);
        }else{
            unset($data['tindak_lanjut']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $complaints->update($data);
        return redirect('/complaint');

    }
}
