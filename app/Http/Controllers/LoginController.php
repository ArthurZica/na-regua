<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->username)->first();
        if(!$user || !\Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }
}
