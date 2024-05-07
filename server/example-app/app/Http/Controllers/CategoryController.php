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

    public function EditCategory(Request $request , $id){
        try{
            $data = Category::where('id', $id)->first();
            return response()->json([
                'name' => $data->name,
                'slug' => $data->slug,
                'status' => $data->status

            ],201);

        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }


    public function UpdateCategory(Request $request , $id){
        try{

            $name = $request->input('name');
            $slug = $request->input('slug');
            $status = $request->input('status');

            $category_data = Category::where('id', $id)->first();

            if(!$category_data){

                return response()->json([
                    'message' => 'No category data found'
    
                ],404);

            }

            $category_data->name = $name;
            $category_data->slug = $slug;
            $category_data->status = $status;
            $category_data->save();

            return response()->json([
                'message' => 'Data updated successfully'

            ],201);

        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }

    public function DeleteCategory(Request $request , $id){
        try{

            $data = Category::where('id',$id)->first();

            if(!$data){

                return response()->json([
                    'message' => 'No category data found'
    
                ],404);

            }

            Category::where('id',$id)->delete();


            return response()->json([
                'message' => 'Data deleted successfully'

            ],201);

        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }


}
