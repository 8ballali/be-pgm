<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class AuthController extends Controller
{
    public function index()
    {

        return view('admin.form-login');

    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            Alert::success('Congrats', 'Login Successfully');
            return redirect('/dashboard');
        }else {
            Alert::error('Error', 'Failed Login');
            return redirect('/');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');

    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required', 'string', 'email', 'max:255',
            'password' => 'required',
        ]);
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/');
    }

}
