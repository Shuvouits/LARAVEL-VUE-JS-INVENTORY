<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

           // $formattedExpireDate = Carbon::parse($expire_date)->format('m/d/Y');


            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,avif,svg,webp|max:2048', // Adjust the validation rules as needed
                ]);

                if ($request->file('avatar')->isValid()) {
                    $avatar = $request->file('avatar')->getClientOriginalName();
                    $request->file('avatar')->move(('images'), $avatar);
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

            $all_product = Product::with('categoryData')->with('brandData')->orderBy('id','DESC')->get();
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


    public function EditProduct(Request $request, $id)
    {
        try {
            $data = Product::where('id', $id)->first();
            return response()->json([
                'name' => $data->name,
                'slug' => $data->slug,
                'price' => $data->price,
                'quantity' => $data->quantity,
                'date' => $data->expire_date,
                'category' => $data->category,
                'brand' => $data->brand,
                'avatar' => $data->avatar

            ], 201);

        } catch (\Exception $error) {
            dd($error->getMessage());

        }
    }


    public function UpdateProduct(Request $request , $id){
        try{

            $name = $request->input('name');
            $slug = $request->input('slug');
            $price = $request->input('price');
            $quantity = $request->input('quantity');
            $expire_date = $request->input('expire_date');

           // return response()->json($expire_date);
            $categoryData = $request->input('categoryData');
            $brandData = $request->input('brandData');

            $product_data = Product::where('id', $id)->first();

            if(!$product_data){

                return response()->json([
                    'message' => 'No product found'
    
                ],404);

            }

            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048', // Adjust the validation rules as needed
                ]);

                if ($request->file('avatar')->isValid()) {
                    $avatar = $request->file('avatar')->getClientOriginalName();
                    $request->file('avatar')->move(('images'), $avatar);
                    $msg = "Image uploaded successfully";
                }

                
                $product_data->name = $name;
                $product_data->slug = $slug;
                $product_data->price = $price;
                $product_data->quantity = $quantity;
                $product_data->expire_date = $expire_date;
                $product_data->category = $categoryData;
                $product_data->brand = $brandData;
                $product_data->avatar = $avatar;
                $product_data->save();

                return response()->json([
                    'message' => 'Product updated with image',

                ], 201);


            }



            $product_data->name = $name;
                $product_data->slug = $slug;
                $product_data->price = $price;
                $product_data->quantity = $quantity;
                $product_data->expire_date = $expire_date;
                $product_data->category = $categoryData;
                $product_data->brand = $brandData;
                
                $product_data->save();

            return response()->json([
                'message' => 'Product updated without image',

            ], 201);


        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }

    public function ExpiredProduct(){
        //$expiryThreshold = Carbon::now()->addDays(15)->toDateString();
        $expiryThreshold = Carbon::now()->toDateString();
        
        
    
        $expired_products = Product::with('brandData')->where('expire_date', '<=', $expiryThreshold)->orderBy('id', 'DESC')
                                    ->get();
    
        return response()->json($expired_products);
    }

    public function LowStock(){
        $product = Product::with('brandData')->with('categoryData')->where('quantity', '<=', 5)->where('quantity', '>', 0)->get();
        return response()->json($product);
    }

    public function OutStock(){
        $product = Product::with('brandData')->with('categoryData')->where('quantity', '=', 0)->get();
        return response()->json($product);
    }

}
