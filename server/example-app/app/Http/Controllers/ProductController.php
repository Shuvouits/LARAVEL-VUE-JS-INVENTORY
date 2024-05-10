<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function AddProduct(Request $request)
    {
        try {


            $name = $request->input('name');
            $slug = $request->input('slug');
            $price = $request->input('price');
            $quantity = $request->input('quantity');
            $expire_date = $request->input('expire_date');
            $category = $request->input('category');
            $brand = $request->input('brand');


            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,avif,webp|max:2048', // Adjust the validation rules as needed
                ]);

                if ($request->file('avatar')->isValid()) {
                    $avatar = $request->file('avatar')->getClientOriginalName();
                    $request->file('avatar')->move(public_path('images'), $avatar);
                    $msg = "Image uploaded successfully";
                }

                $product = new Product();
                $product->name = $name;
                $product->slug = $slug;
                $product->price = $price;
                $product->quantity = $quantity;
                $product->expire_date = $expire_date;
                $product->category = $category;
                $product->brand = $brand;
                $product->avatar = $avatar;
                $product->save();

                return response()->json([
                    'message' => 'New product insert with image',

                ], 201);


            }

            $product = new Product();
                $product->name = $name;
                $product->slug = $slug;
                $product->price = $price;
                $product->quantity = $quantity;
                $product->expire_date = $expire_date;
                $product->category = $category;
                $product->brand = $brand;
                $product->save();

                return response()->json([
                    'message' => 'New product insert without image',

                ], 201);



        } catch (\Exception $error) {
            dd($error->getMessage());
        }
    }

    public function AllProduct(Request $request){

        try {

            $all_product = Product::all();
            return response()->json($all_product);

        } catch (\Exception $error) {
            dd($error->getMessage());
        }
       
    }

    public function DeleteProduct(Request $request , $id){
        try{

            $data = Product::where('id',$id)->first();

            if(!$data){

                return response()->json([
                    'message' => 'No product found'
    
                ],404);

            }

            Product::where('id',$id)->delete();


            return response()->json([
                'message' => 'Data deleted successfully'

            ],201);

        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }

}
