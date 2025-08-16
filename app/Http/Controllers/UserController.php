<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\SigninRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signup(SignupRequest $signupRequest)
    {
        try {
            $data = $signupRequest->validated();

            $user = User::create($data);

            if ($user) {
                return response()->json([
                    'user' => $user,
                    'message' => 'Created successfully'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function signin(SigninRequest $signinRequest)
    {
        try {
            $data = $signinRequest->validated();

            if (!Auth::attempt($data)) {
                return response()->json([
                    'errors' => 'Invalid email address or password, please try again.'
                ], 423);
            }

            $user = Auth::user();
            $token = $user->createToken('access_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'Loggedin successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $user->currentAccessToken()->delete();

            return response()->json([
                'message' => 'Logout successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
