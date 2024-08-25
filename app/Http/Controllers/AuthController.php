<?php

namespace App\Http\Controllers;

use App\Models\oauthAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TokenHistory;
class AuthController extends Controller
{
    public function login(){

        request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
            // Create access token
            $accessToken = Auth::user()->createToken('access_token');

            // Store token history
            TokenHistory::create([
                'user_id' => auth()->user()->id,
                'token' => base64_encode($accessToken->token->id),
                'expires_at' => $accessToken->token->expires_at,
            ]);

            return response()->json([
                'user_id' => auth()->user()->id,
                'token_type' => 'Bearer',
                'access_token' => $accessToken->accessToken,
                'expires_at' => $accessToken->token->expires_at,
                'message' => 'Authentication Successful!',
            ]);

        } else {
            // If the authentication fails
            return response()->json([
                'error' => 'The provided credentials do not match our records.'
            ], 401);
        }


    }

    public function logout(){

        //delete users token
        oauthAccessToken::where('user_id', auth()->user()->id)->delete();

        return response()->json([
            'message' => 'Toke revoked!'
        ],200);
    }


}

