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

    public function Setting(Request $request){

        $user_phone = $request->user->phone;
        $user = User::where('phone', $user_phone)->first();

        if(!$user){
            return response()->json(['message' => 'User Not Found'], 401);

        }

        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $confirmed_password = $request->input('confirmed_password');

        if($user && Hash::check($current_password, $user->password)){

            if($new_password == $confirmed_password){

                User::findOrFail($user->id)->update([
                    'password' => bcrypt($new_password),
                     
                ]); 
                
                return response()->json(['message' => 'Your password updated'], 201);

            }else{
                return response()->json(['message' => 'Yor confirmed password not matched'], 400);
            }

        }

        
    }
}
