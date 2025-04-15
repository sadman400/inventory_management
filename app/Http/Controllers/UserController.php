<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\SendOTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            ], 200)->cookie('token', $token, 60);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'login failed!',
            ], 401);
        }
    }



    public function send_otp (Request $request) {
        $email = $request->validate([
            'email' => 'required'
        ]);
        $otp = rand(1000, 9999);
        $user = User::where('email', $email)->first();
        if ($user) {
            Mail::to($user->email)->send(new SendOTP($otp, $user->name));
            User::where('email', $user->email)->update([
                'otp' => $otp
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'OTP sended successful',
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to send OTP',
            ], 400);
        }
    }


    public function verify_otp (Request $request) {
        $request->validate([
            'email' => 'email',
            'otp' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('otp', $request->otp)->first();
        if ($user) {
            $token = JWTToken::create_token_verification($user->email);
            User::where('email', $user->email)->update([
                'otp' => '0'
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'otp verification successful',
                'token' => $token,
            ], 200)->cookie('token', $token, 60);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'otp verification failed',
            ], 401);
        }
    }


    public function password_reset (Request $request) {
        $email = $request->header('email');
        $request->validate([
            'password' => 'required'
        ]);
        $user = User::where('email', $email)->first();
        if ($user) {
            User::where('email', $email)->update([
                'password'=>$request->password
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'password reset successful',
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'unable to reset the password!',
            ], 401);
        }
    }


    public function logout () {
        return response()->json([
            'status' => 'failed',
            'message' => 'logout successful',
        ], 200)->cookie('token', '', -1);
    }
}




