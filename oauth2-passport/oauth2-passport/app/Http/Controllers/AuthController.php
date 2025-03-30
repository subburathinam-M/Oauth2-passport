<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class AuthController extends Controller
{
    public function register(Request $request){
        $request-> validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required' 
        ]);


        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return response()->json(['message'=>'User created successfully', 'user'=>$user],201);
    }


    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        
        $user = User::where('email', $request->email)->first();

     if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        $token = $user->createToken('API Token', ['*'])->accessToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => 3600,
            'user' => $user
        ], 200);
    }
    



    public function userProfiles(){
        // $user = Auth::user();
        return response()->json(['user'=> auth()->user()],200);
    }
}

