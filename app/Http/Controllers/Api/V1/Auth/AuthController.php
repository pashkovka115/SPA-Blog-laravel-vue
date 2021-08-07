<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|min:6|string|confirmed',
//            'password_confirmation' => 'required|min:6'
        ]);

        $fields['password'] = bcrypt($fields['password']);
        $user = User::create($fields);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user or !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Не верная пара логин/пароль'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Выход из системы.'
        ];
    }


    /*
     * Возвращает пользователя по токену
     */
    public function getAuthUser(Request $request)
    {
        return new AuthUserResource($request->user());
    }
}
