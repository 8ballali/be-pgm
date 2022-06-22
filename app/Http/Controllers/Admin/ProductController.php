<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
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

class ProductController extends Controller
{
    public function index()
    {
        $employee = Employee::get();
        $department = Department::all();
        $product = Product::all();
        $logged_in = Auth::id();
        if (Auth::user()->role_id == 1) {
            $roles = Auth::user()->roles->name;
            $name = $roles;
        }else {
            $employee_name = Employee::where('user_id', $logged_in)->select('name')->get();
            $name = $employee_name[0]->name;
        }
        return view('admin.product', compact('product', 'department', 'name'));

    }
    public function store(Request $request)
    {
        // dd($request->all());
        // return $request;
        $this->validate($request, [
            'blok' => 'required',
            'no_kavling' => 'required',
            'type' => 'required',
            'luas_tanah' => 'required',
            'price' => 'required',
            'status' => 'required',
            'tanah_lebih' => 'required',
            'discount' => 'required',
        ]);
        if ($request->image){
            $file =$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $name='image/'.date('dmYhis').".".$ext;
            $file->move('image/',$name);
            $product = Product::create([
                'blok' => $request->blok,
                'no_kavling' => $request->no_kavling,
                'type' => $request->type,
                'luas_tanah' => $request->luas_tanah,
                'price' => $request->price,
                'status' => $request->status,
                'tanah_lebih' => $request->tanah_lebih,
                'discount' => $request->discount,
                'image' => $name,

            ]);
            // $employee->avatar=$name;
        }
        else{$product = Product::create([
            'blok' => $request->blok,
            'no_kavling' => $request->no_kavling,
            'type' => $request->type,
            'luas_tanah' => $request->luas_tanah,
            'price' => $request->price,
            'status' => $request->status,
            'tanah_lebih' => $request->tanah_lebih,
            'discount' => $request->discount,


        ]);}
        return redirect('/product');
    }
    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/product');
    }
    public function update(Request $request, $id){
        $product=Product::find($id);
        if ($request->image){
            $file =$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $name='image/'.date('dmYhis').".".$ext;
            $file->move('image/',$name);
            $product->image=$name;

        }
        $product->blok=$request->blok;
        $product->no_kavling=$request->no_kavling;
        $product->type=$request->type;
        $product->luas_tanah=$request->luas_tanah;
        $product->price=$request->price;
        $product->status=$request->status;
        $product->tanah_lebih=$request->tanah_lebih;
        $product->discount=$request->discount;
        if($product->save()){

            return redirect('/product');
        }




    }
}
