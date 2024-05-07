<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function AddCategory(Request $request){

        try{

            $name = $request->input('name');
            $slug = $request->input('slug');
            $status = $request->input('status');
    
            $category = New Category();
    
            $category->name = $name;
            $category->slug = $slug;
            $category->status = $status;
    
            $category->save();
    
            return response()->json(['message'=> 'New Category Added Successfully'], 201);

        }catch(error){

            return response()->json(['message'=> 'Something wrong right now'], 500);

        }
       

    }

    public function AllCategory(){

        try{

            $category = Category::all();
    
            return response()->json($category);

        }catch(\Exception $error){

            dd($error->getMessage());

        }
       

    }
}
