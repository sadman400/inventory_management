<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {

    private static function get_key() {
        return env('JWT_KEY');
    }

    public static function create_token($email, $id) {
        return JWT::encode([
            'iss' => 'login-token',
            'iat' => time(),
            'exp' => time() + 3600,
            'email' => $email,
            'id' => $id,
        ], self::get_key(), 'HS256');
    }

    public static function verify_token($token) {
        try {
            return JWT::decode($token, new Key(self::get_key(), 'HS256'));
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized',
            ], 401);
        }
    }
}