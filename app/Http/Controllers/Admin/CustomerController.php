<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        // $user = User::where('role_id', '2');

        $customer = Customer::get();
        $department = Department::all();
        $logged_in = Auth::id();
        if (Auth::user()->role_id == 1) {
            $roles = Auth::user()->roles->name;
            $name = $roles;
        }else {
            $employee_name = Employee::where('user_id', $logged_in)->select('name')->get();
            $name = $employee_name[0]->name;
        }
        return view('admin.customer', compact('customer', 'department', 'name'));

    }
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'nik' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
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
            'role_id' => 3
        ]);

            Customer::create([
                'nik' => $request->nik,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'dept_id' => $request->dept_id,
                'user_id' => $register->id,
                'avatar' => $avatar,

            ]);
            toast('Your Post as been submited!','success');
            return redirect('/customer');

    }
    public function delete($user_id)
    {
        $user = User::findOrFail($user_id);
        // dd($user, $user->employee) ;
        $user->customer->delete();
        $user->delete();
        return redirect('/customer');
    }
    public function update(Request $request, $id){
        $data = $request->all();
        $rules = [
            'address' => 'required',
            'phone' => 'required',
        ];
        $this->validate($request, [
        ]);
        $customer = Customer::find($id);
        $user=User::find($customer->user_id);
        if (request()->hasFile('avatar')) {
            $avatar = request()->file('avatar')->store('avatar', 'public');
            if (Storage::disk('public')->exists($customer->avatar)) {
                Storage::disk('public')->delete([$customer->avatar]);
            }
            $avatar = request()->file('avatar')->store('avatar', 'public');
            $data['avatar'] = $avatar;
            $customer->update($data);
        }else{
            unset($data['avatar']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user->email=$request->email;
        $customer->nik=$request->nik;
        $customer->name=$request->name;
        $customer->address=$request->address;
        $customer->phone=$request->phone;
        $user->save();
        $customer->save();

        if($user->save() && $customer->save()){
            toast('Customer Updated!','success');
            return redirect('/customer');
        }




    }

}
