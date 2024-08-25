<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $users = User::get();

        return response()->json([
            'users'=> $users
        ],200);
    }

    public function register(){

        request()->validate([
            'username' => 'required',
            'password' => 'required|confirmed',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email'
        ]);

        try {

            //store user
            User::create([
                'first_name' => request('first_name'),
                'last_name' => request('last_name'),
                'username' => request('username'),
                'password' => bcrypt(request('password_confirmation')),
                'email' => request('email'),
            ]);

            return response()->json([
                'message' => 'Successfully created an account'
            ], 200);

        }catch (\Exception $e){
           return response()->json([
                'message' => 'someting went wrong!'
            ], 500);

        }
    }

}
