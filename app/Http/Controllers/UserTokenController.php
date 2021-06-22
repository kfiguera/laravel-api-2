<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Sanctum;

class UserTokenController extends Controller
{
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = User::where('email', $request->email)->first();

        if (!$user && Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'El email no existe o no coincide con nuestros datos'
            ]);
        }
        return response()->json([
            'token' => $user->createToken($request->name)->plainTextToken
        ]);
    }

    public function validateLogin(Request $request)
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required',
        ]);
    }
}
