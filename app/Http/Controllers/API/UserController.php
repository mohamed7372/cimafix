<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'password' => Hash::make($fields['password']),
        ]);

        $response = [
            'success' => true,
            'message' => "Registration successful."
        ];
        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required',
        ]);

        $user = User::where('name', $credentials['name'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'name' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'access_token' => $token,
            'message' => 'Login successful',
        ], Response::HTTP_OK);
    }

}
