<?php

namespace App\Http\Controllers\Core;

use App\Actions\LoginAction;
use App\Http\Resources\UserResource;
use App\Models\Core\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login (Request $request, LoginAction $loginAction) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ]);

        if (!Auth::attempt($request->all(), true)) {
            return response('Wrong password!', 403);
        }

        $tokenResult = auth()->user()->createToken('Personal Access Token');

        $token = $tokenResult->token;

        $token->expires_at = now()->addYear();

        $token->save();

        $t = "Bearer " . $tokenResult->accessToken;

        return (new UserResource(Auth::user()))->additional([
            'token' => $t
        ]);
    }

    public function logout (Request $request) {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Successfully logged out!']);
    }
}
