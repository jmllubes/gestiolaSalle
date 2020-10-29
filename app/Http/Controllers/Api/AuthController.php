<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'string',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                        'result' => 'error',
                        'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $remember = $request->remember_me;
        if ($remember === "1") {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        
        $type = $user->type;
        $unsuscribe = $user->unsuscribe;

        return response()->json([
                    'result' => 'success',
                    'type_user' => $type,
                    'unsuscribe' => $unsuscribe,
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
                    'result' => 'success',
                    'message' => 'Logged out',
        ]);
    }
}
