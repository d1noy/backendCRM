<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Registration user
     *
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(RegistrationRequest $request)
    {
        User::query()->create($request->validated());
       return response()->json([
           'success' => true,
       ], 201);
    }

    /**
     * Login user
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if(auth()->attempt($request->validated())) {
            $user = auth()->user()->createToken('api_token');
            return response()->json(['token' => $user->plainTextToken]);
        }
        return response()->json([
            'message' => 'Invalid data',
            'errors' => [
                "email" => ["Invalid email or password."],
            ],
        ],422);
    }
}
