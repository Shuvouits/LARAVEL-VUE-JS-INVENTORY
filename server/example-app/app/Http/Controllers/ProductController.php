<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function AddProduct(Request $request)
{
    try {
        // Retrieve request data
        $name = $request->input('name');
        $slug = $request->input('slug');
        $price = $request->input('price');
        $quantity = $request->input('quantity');
        $expire_date = $request->input('expire_date');
        $category = $request->input('category'); // Check if this is an array or a single value
        $brand = $request->input('brand'); // Check if this is an array or a single value
        $avatar = null; // Initialize avatar variable

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,avif,webp|max:2048', // Adjust the validation rules as needed
            ]);

            if ($request->file('avatar')->isValid()) {
                $avatar = $request->file('avatar')->getClientOriginalName();
                $request->file('avatar')->move(public_path('images'), $avatar);
            }
        }

        // Create new Product instance
        $product = new Product();
        $product->name = $name;
        $product->slug = $slug;
        $product->price = $price;
        $product->quantity = $quantity;
        $product->expire_date = $expire_date;
        $product->avatar = $avatar; // Assign avatar value
        // Assign category and brand values based on your logic
        // Ensure that these values are properly formatted for the database
        // For example, if they are arrays, you might need to serialize them or save them in a separate table
        $product->category = $category; 
        $product->brand = $brand;
        $product->save();

        return response()->json([
            'message' => 'Product inserted successfully',
        ], 201);

    } catch (\Exception $error) {
        dd($error->getMessage());
    }
}



   
}
  