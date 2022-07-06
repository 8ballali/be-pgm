<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\userResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerAdmin(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'role_id' => ['required'],
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $register = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1
        ]);

        if ($register) {
            return response()->json([
                'success' =>true,
                'message' => 'Registrasi Admin Berhasil',
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'success' =>false,
                'message' => 'Registrasi Gagal',
            ], 400);
        }
    }

    public function loginAdmin(Request $request)
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
                'meta' => [
                    'code' => 200,
                    'status' => 'Success',
                    'message' => 'Authenticated'
                ],
                'data' => [
                    'accessToken' => $tokenResult,
                    'token_type'  => 'Bearer',
                    'user'        => new userResource($user)
                ],

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

}
