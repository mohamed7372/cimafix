<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Auth\RegisterValidator;
use App\Http\Requests\Auth\LoginValidator;

class AuthController extends Controller
{
    public function register(RegisterValidator $request)
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

    public function login(LoginValidator $request)
    {
        $user = User::where('name', $request['name'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
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
