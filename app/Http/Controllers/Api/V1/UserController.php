<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        // Check email
        $user = User::where('email', $data['email'])->firstOrFail();

        // Check password
        if (!$user or !Hash::check($data['password'], $user->password)){
            return response([
                'message' => 'Не верная пара логин/пароль'
            ], 401);
        }

        unset($data['email']);
        unset($data['password']);
        $user->update($data);

        return new UserResource($user);
    }


    public function destroy($id)
    {
        //
    }
}
