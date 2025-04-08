<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public static function loginUser($userData)
    {
        try {

            if (!Auth::attempt($userData)) {
                return [
                    "success" => false,
                    "error" => "Unauthorized"
                ];
            }

            $user = Auth::user();
            $user->token = JWTAuth::fromUser($user);

            return [
                "success" => true,
                "user" => $user
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }
}
