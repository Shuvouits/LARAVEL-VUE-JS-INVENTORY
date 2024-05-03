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
           

            //$token = JWTAuth::attempt(['phone' => $phone, 'password' => $password]);

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

        try{
    
            $user_phone = $request->user->phone;
            $user = User::where('phone', $user_phone)->first();
    
            if(!$user){
                return response()->json(['message' => 'User Not Found'], 401);
    
            }
    
            $current_password = $request->input('current_password');
            $new_password = $request->input('new_password');
            $confirmed_password = $request->input('confirmed_password');
    
            if(strlen($current_password) < 8){
               return response()->json(['message' => 'Current password should be more than 8 characters'], 401);
            }

            if(strlen($new_password) < 8){
                return response()->json(['message' => 'New password should be more than 8 characters'], 401);
             }
    
            if($user && Hash::check($current_password, $user->password)){
    
                if($new_password == $confirmed_password){

                    $token = JWTAuth::attempt(['phone' => $user_phone, 'password' => $current_password]);
    
                    User::findOrFail($user->id)->update([
                        'password' => bcrypt($new_password),
                         
                    ]); 

                    

                    
                    
                    return response()->json([
                        'message' => 'Your password updated',
                        'phone' => $user_phone,
                        'token' => $token
                         
                    ], 201);
    
                }else{
                    return response()->json(['message' => 'Your confirmed password does not match'], 400);
                }
    
            }else{
    
                return response()->json(['message' => 'Your current password does not match'], 401);
    
            }
    
        } catch(\Exception $error) {
            // Handle the exception
            dd($error->getMessage());
        }
    }
    
}
