<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function Login(Request $request)
    {


        /*$data = User::create([
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'name' => $request->name,
        ]); */

        $phone = $request->input('phone');
        $password = $request->input('password');

        $user = User::where('phone', $phone)->first();

        if ($user && Hash::check($password, $user->password)) {


            //$token = JWTAuth::attempt(['phone' => $phone, 'password' => $password]);

            $token = JWTAuth::attempt(['phone' => $phone, 'password' => $password]);

            User::where('phone', $phone)->update([

                'token' => $token,

            ]);

            $currentDate = Carbon::now();
            $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
            $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();

            $top_customer = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->with('customer')->orderBy('g_total', 'DESC')->limit(10)->get();
            $out_of_stock = Product::where('quantity', 0)->get();

            return response()->json([
                'token' => $token,
                'phone' => $phone,
                'email' => $user->email,
                'name' => $user->name,
                'address' => $user->address,
                'avatar' => $user->avatar,
                'top_customer' => $top_customer,
                'out_of_stock' => $out_of_stock,
                'message' => 'Login successful',
                // Add more user data here if needed
            ], 200);


        } else {

            return response()->json(['message' => 'Invalid phone number or password'], 401);
        }


    }

    public function Setting(Request $request)
    {

        try {

            $user_phone = $request->user->phone;
            $user = User::where('phone', $user_phone)->first();
            $token = $user->token;

            if (!$user) {
                return response()->json(['message' => 'User Not Found'], 401);

            }

            $current_password = $request->input('current_password');
            $new_password = $request->input('new_password');
            $confirmed_password = $request->input('confirmed_password');

            if (strlen($current_password) < 8) {
                return response()->json(['message' => 'Current password should be more than 8 characters'], 401);
            }

            if (strlen($new_password) < 8) {
                return response()->json(['message' => 'New password should be more than 8 characters'], 401);
            }

            if ($user && Hash::check($current_password, $user->password)) {

                if ($new_password == $confirmed_password) {

                    // $token = JWTAuth::attempt(['phone' => $user_phone, 'password' => $current_password]);

                    User::findOrFail($user->id)->update([
                        'password' => bcrypt($new_password),

                    ]);

                    $currentDate = Carbon::now();
                    $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
                    $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();

                    $top_customer = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->with('customer')->orderBy('g_total', 'DESC')->limit(10)->get();
                    $out_of_stock = Product::where('quantity', 0)->get();





                    return response()->json([
                        'message' => 'Your password updated',
                        'phone' => $user_phone,
                        'name' => $user->name,
                        'address' => $user->address,
                        'avatar' => $user->avatar,
                        'token' => $token,
                        'top_customer' => $top_customer,
                        'out_of_stock' => $out_of_stock

                    ], 201);

                } else {
                    return response()->json(['message' => 'Your confirmed password does not match'], 400);
                }

            } else {

                return response()->json(['message' => 'Your current password does not match'], 401);

            }

        } catch (\Exception $error) {
            // Handle the exception
            dd($error->getMessage());
        }
    }

    public function ProfileUpdate(Request $request)
    {
        try {

            $user_id = $request->user->id;
            $token = $request->user->token;

            $name = $request->input('name');
            $phone = $request->input('phone');
            $address = $request->input('address');
            $email = $request->input('email');

            $currentDate = Carbon::now();
            $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
            $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();

            $top_customer = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->with('customer')->orderBy('g_total', 'DESC')->limit(10)->get();
            $out_of_stock = Product::where('quantity', 0)->get();


            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,avif,webp|max:2048', // Adjust the validation rules as needed
            ]);

            if ($request->file('avatar')->isValid()) {

                $avatar = $request->file('avatar')->getClientOriginalName();
                $request->file('avatar')->move(('images'), $avatar);
                $msg = "Image uploaded successfully";









                User::where('id', $user_id)->update([
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'avatar' => $avatar,
                    'top_customer' => $top_customer,
                    'out_of_stock' => $out_of_stock

                ]);
            } else {

                User::where('id', $user_id)->update([
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,

                    'top_customer' => $top_customer,
                    'out_of_stock' => $out_of_stock

                    //'avatar' => $avatar

                ]);

            }

            return response()->json([
                'message' => 'Your profile is updated',
                'phone' => $phone,
                'token' => $token,


            ], 201);


        } catch (\Exception $error) {
            dd($error->getMessage());
        }
    }

    public function ProfileSetting(Request $request)
    {

       

        $user_id = $request->user->id;
        $token = $request->user->token;

        $name = $request->input('name');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $email = $request->input('email');

        $currentDate = Carbon::now();
        $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
        $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();

        $top_customer = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->with('customer')->orderBy('g_total', 'DESC')->limit(10)->get();
        $out_of_stock = Product::where('quantity', 0)->get();

        


        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,avif,webp|max:2048', // Adjust the validation rules as needed
            ]);

            if ($request->file('image')->isValid()) {
                $avatar = $request->file('image')->getClientOriginalName();
                $request->file('image')->move(('images'), $avatar);
                $msg = "Image uploaded successfully";



                User::where('id', $user_id)->update([
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'avatar' => $avatar,
                    

                ]);

                return response()->json([
                    "message" => 'Profile updated with image',
                    'token' => $token,
                    'phone' => $phone,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'avatar' => $avatar,

                    'top_customer' => $top_customer,
                    'out_of_stock' => $out_of_stock

                ], 201);
            } else {


            }

        }

        User::where('id', $user_id)->update([
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'phone' => $phone,

        ]);

        $user = User::where('id', $user_id)->first();

        return response()->json([
            "message" => 'Profile updated without image',
            'token' => $token,
            'email' => $email,
            'phone' => $phone,
            'name' => $name,
            'address' => $address,
            'avatar' => $user->avatar,

            'top_customer' => $top_customer,
            'out_of_stock' => $out_of_stock

        ], 201);
    }

}
