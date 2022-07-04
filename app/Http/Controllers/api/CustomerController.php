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
        $customer = Customer::create([
            'name' => $request->name,
            'nik'  => $request->nik,
            'address' => $request->address,
            'avatar' => $avatar,
            'phone' => $request->phone,
            'user_id' => $register->id,

        ]);
        if ($register) {
            return response()->json([
                'success' =>true,
                'message' => 'Registrasi Berhasil',
                'data' => $customer
            ], 201);
        } else {
            return response()->json([
                'success' =>false,
                'message' => 'Registrasi Gagal',

            ], 200);
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
                    'success' => false,
                    'message' => 'Wrong Email or Password',
                ],200);
            }
            // Jika Hash Tidak sesuai maka Error
            $user = User::where('email', $request->email)->first();
            $user->tokens()->delete();
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Authenticated',
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'data' => $user,
                // 'subscribers' => new UserDataResource($user)
            ]);
        } catch (Exception $error ) {
            return response()->json([
                'message' => "Authentication Failed " . $error
            ]);
        }
    }
    public function logout () {
        $user = request()->user(); //or Auth::user()
        // Revoke current user token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil',

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
                'message' => 'User Not Found'
            ]);
        }
        if (request()->hasFile('avatar')) {
            $avatar = request()->file('avatar')->store('image', 'public');
            if (Storage::disk('public')->exists($customer->avatar)) {
                Storage::disk('public')->delete([$customer->avatar]);
            }
            $image = request()->file('avatar')->store('image', 'public');
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
        $response = [
            'success'   => true,
            'message'   => 'Data Customer Updated',
            'data'      => $customer,
        ];
        return response()->json($response, Response::HTTP_OK);

    }
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        if ($customer) {
            return response()->json([
                'success' => true,
                'message' => 'Detail User',
                'data' => $customer
            ],200);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'User Not Found',
                'data' => []
            ],200);
        }

    }
}
