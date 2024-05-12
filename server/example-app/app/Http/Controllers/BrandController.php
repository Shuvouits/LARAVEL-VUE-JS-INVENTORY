<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function AddBrand(Request $request)
    {
        try {

            $name = $request->input('name');
            $status = $request->input('status');
            $slug = $request->input('slug');

            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,avif,webp,svg|max:2048', // Adjust the validation rules as needed
                ]);

                if ($request->file('avatar')->isValid()) {
                    $avatar = $request->file('avatar')->getClientOriginalName();
                    $request->file('avatar')->move(public_path('images'), $avatar);
                    $msg = "Image uploaded successfully";
                }

                $brand = new Brand();
                $brand->name = $name;
                $brand->slug = $slug;
                $brand->status = $status;
                $brand->avatar = $avatar;
                $brand->save();

                return response()->json([
                    'message' => 'New brand insert with image',

                ], 201);


            }

            $brand = new Brand();
            $brand->name = $name;
            $brand->slug = $slug;
            $brand->status = $status;
            $brand->save();

            return response()->json([
                'message' => 'New brand insert without image',

            ], 201);



        } catch (\Exception $error) {
            dd($error->getMessage());
        }
    }

    public function AllBrand()
    {

        try {

            $brand = Brand::orderBy('id','DESC')->get();

            return response()->json($brand);

        } catch (\Exception $error) {

            dd($error->getMessage());

        }


    }

    public function DeleteBrand(Request $request, $id)
    {
        try {

            $data = Brand::where('id', $id)->first();

            if (!$data) {

                return response()->json([
                    'message' => 'No brand data found'

                ], 404);

            }

            Brand::where('id', $id)->delete();


            return response()->json([
                'message' => 'Data deleted successfully'

            ], 201);

        } catch (\Exception $error) {
            dd($error->getMessage());

        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {

            $data = Brand::where('id', $id)->first();

            if (!$data) {

                return response()->json([
                    'message' => 'No brand data found'

                ], 404);

            }

            if ($data->status == 'Active') {
                $data->status = "Inactive";
                $data->save();
            } else {
                $data->status = 'Active';
                $data->save();
            }


            return response()->json([
                'message' => 'Update your brand status'

            ], 201);

        } catch (\Exception $error) {
            dd($error->getMessage());

        }
    }

    public function EditBrand(Request $request, $id)
    {
        try {
            $data = Brand::where('id', $id)->first();
            return response()->json([
                'name' => $data->name,
                'slug' => $data->slug,
                'status' => $data->status,
                'avatar' => $data->avatar

            ], 201);

        } catch (\Exception $error) {
            dd($error->getMessage());

        }
    }

    public function UpdateBrand(Request $request , $id){
        try{

            $name = $request->input('name');
            $slug = $request->input('slug');
            $status = $request->input('status');

            $brand_data = Brand::where('id', $id)->first();

            if(!$brand_data){

                return response()->json([
                    'message' => 'No category data found'
    
                ],404);

            }

            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,avif,webp,svg|max:2048', // Adjust the validation rules as needed
                ]);

                if ($request->file('avatar')->isValid()) {
                    $avatar = $request->file('avatar')->getClientOriginalName();
                    $request->file('avatar')->move(public_path('images'), $avatar);
                    $msg = "Image uploaded successfully";
                }

                
                $brand_data->name = $name;
                $brand_data->slug = $slug;
                $brand_data->status = $status;
                $brand_data->avatar = $avatar;
                $brand_data->save();

                return response()->json([
                    'message' => 'New brand updated with image',

                ], 201);


            }



            $brand_data->name = $name;
            $brand_data->slug = $slug;
            $brand_data->status = $status;
            $brand_data->save();

            return response()->json([
                'message' => 'New brand updated without image',

            ], 201);


        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }





}
