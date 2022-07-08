<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function register(Request $request)
    {

        $data = $request->all();
        $rules = [
            'nik' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ];
        // $avatar = null;
        // if ($request->avatar instanceof UploadedFile) {
        //     $avatar = $request->avatar->store('avatar', 'public');
        //     $data['avatar'] = $avatar;
        // }else{
        //     unset($data['avatar']);
        // }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $register = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3
        ]);
        $customer = Customer::create([
            'name' => $request->name,
            'nik'  => $request->nik,
            'address' => $request->address,
            // 'avatar' => $avatar,
            'phone' => $request->phone,
            'user_id' => $register->id,

        ]);
        if ($register) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'Success',
                    'message' => 'Data Customer Created'
                ],
                'data' => [

                    'customer'        => $customer
                ]
            ]);
        } else {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'Failed',
                    'message' => "Registration Failed"
                ],],200);
        }
    }
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            //Check Credentials
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'meta' => [
                        'code' => 500,
                        'status' => 'Failed',
                        'message' => "Wrong Email or Password"
                    ],],200);
            }
            // Jika Hash Tidak sesuai maka Error
            $user = User::where('email', $request->email)->first();
            $user->tokens()->delete();
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'Success',
                    'message' => 'Authenticated'
                ],
                'data' => [
                    'accessToken' => $tokenResult,
                    'token_type'  => 'Bearer',
                    'user'        => $user
                ],

                // 'subscribers' => new UserDataResource($user)
            ]);

        } catch (Exception $error ) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' =>'Failed',
                    'message' => "Authentication Failed " . $error
                ],
                // 'message' => "Authentication Failed " . $error
            ]);
        }
    }
    public function logout () {
        $user = request()->user(); //or Auth::user()
        // Revoke current user token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Logout Berhasil',
            ]
        ],200);
    }
    public function update(Request $request, $id )
    {
        $data = $request->all();
        $rules = [
            'name'          => 'required',
            'address'       => 'required',
            'gender'        => 'required',
            'phone'         => 'required',
        ];
        $this->validate($request, [
        ]);
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'status' => 'Failed',
                    'message' => 'Customer Not Found'
                ],

            ],200);
        }
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
        $customer->update($data);
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data Customer updated successfully'
            ],
            'data' => [
                'customer' => $customer
            ]
        ]);

    }
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        if ($customer) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Detail Customer',
                ],
                'data' => [
                    'customer' => $customer
                ],
            ],200);
        }else {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'status' => 'Failed',
                    'message' => 'Customer Not Found'
                ],
            ],200);
        }

    }
}
