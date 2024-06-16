<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        return User::create($request->all());
    }

    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                "message" => "Wrong email or password"
            ], 401);
        }
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json([
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "token" => $user->createToken($user->email)->plainTextToken
            ],
        ]);
    }

    public function logout()
    {
        return 'logout';
    }
}
