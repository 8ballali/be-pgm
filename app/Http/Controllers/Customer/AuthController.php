<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
         $request->validate([
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|string',
            'nik' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);
        if($request->avatar){
            $avatar=$request->file('avatar');
            $avatarName=$avatar->getClientOriginalName();
            $getExt=$avatar->getClientOriginalExtension();
            $fileName="AVA".date('YdmYdmYhis').".".$getExt;
            $avatar->move('avatar/',$fileName);
            $file="avatar/".$fileName;
        }else{
            $file=null;
        }

        $user = User::create([
            'email' =>$request['email'],
            'password' => Hash::make($request['password']),
            'role' => "CUSTOMER",

        ]);
        $select_user = User::where('email',$request['email'])->first();

        $customer = Customer::create([
            'nik' => $request['nik'],
            'name' => $request['name'],
            'avatar'=>$file,
            'address' => $request['address'],
            'phone' => $request['phone'],
            'user_id' => $select_user->id
        ]);
        if($customer){
            return response()->json(['success'=>1,'message'=>'Register Berhasil']);
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:191',
            'password' => 'required|string',
        ]);
        if(Auth::attempt(['email'=>$request['email'], 'password'=>$request['password']])){
            $user = User::where('id', Auth::user()->id)->first();
            $token = $user->createToken('tokens')->accessToken;
            return response()->json(['success'=>1,'message'=>'Login Berhasil', 'data'=>$user, 'token'=>$token]);

        }
    }

}
