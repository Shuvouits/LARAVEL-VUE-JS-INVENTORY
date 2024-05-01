<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    public function Login(Request $request){


        /*$data = User::create([
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'name' => $request->name,
        ]); */

        $phone = $request->input('phone');
        $password = $request->input('password');
    
        $user = User::where('phone', $phone)->first();

        if($user && Hash::check($password, $user->password)){
           

            $token = JWTAuth::attempt(['phone' => $phone, 'password' => $password]);

            return response()->json([
                'token' => $token,
                'phone' => $phone,
                'message' => 'Login successful',
                // Add more user data here if needed
            ], 200);


        } else {
            
            return response()->json(['message' => 'Invalid phone number or password'], 401);
        }

        
    }
}
