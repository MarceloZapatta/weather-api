<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('authToken')->plainTextToken;

            return $this->returnUserWithToken($token);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * Return user with token.
     *
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnUserWithToken(string $token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Authorized with success!',
            'user' => auth()->user(),
            'token' => $token
        ]);
    }

    /**
     * Returns current authenticated user.
     *
     * @return UserResource
     */
    public function user(): UserResource
    {
        return new UserResource(auth()->user());
    }

    /**
     * Logout a user and revoke the token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
