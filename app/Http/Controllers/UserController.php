<?php

namespace App\Http\Controllers;

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
}
