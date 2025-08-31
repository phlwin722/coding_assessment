<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function Login(UserRequest $request)
    {
        try {
            $loginField = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            $credentials = [
                $loginField => $request->input('username'),
                'password' => $request->input('password'),
            ];

            $remember = $request->boolean('remember');

            if (!Auth::attempt($credentials, $remember)) {
                return response()->json([
                    'error' => 'Invalid username or password, please try again.'
                ], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('auth:sanctum')->plainTextToken;

            return response()->json([
                'user' => $user,
                'access_token' => $token,
                'message' => 'Loggedin successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function Logout(Request $request)
    {
        try {
            $user = $request->user();

            $user->currentAccessToken()->delete();

            return response()->json([
                'status' => 201
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
