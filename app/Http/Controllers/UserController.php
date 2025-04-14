<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_register (Request $request) {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required',
            'password' => 'required',
        ]);
        User::create($fields);
        return response()->json([
            'status' => 'success',
            'message' => 'user registration successful',
        ], 201);
    }

    public function user_login (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('password', $request->password)->first();
        if ($user) {
            $token = JWTToken::create_token($user->email, $user->id);
            return response()->json([
                'status' => 'success',
                'message' => 'user login successful',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'login failed!',
            ], 401);
        }
    }
}
