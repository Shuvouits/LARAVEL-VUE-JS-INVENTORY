<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function AddSupplier(Request $request){

        $name = $request->input('name');
        $address = $request->input('address');

        $customer = new Supplier();
        $customer->name = $name;
        $customer->address = $address;
        $customer->save();

        return response()->json(['message' => "New supplier inserted"]);

    }

    public function AllSupplier(){

        $customer = Supplier::orderBy('id','DESC')->get();
 
         return response()->json($customer);
 
     }

     public function EditSupplier(Request $request , $id){
        try{
            $data = Supplier::where('id', $id)->first();
            return response()->json([
                'name' => $data->name,
                'address' => $data->address

            ],201);

        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }

    public function UpdateSupplier(Request $request , $id){
        try{

            $name = $request->input('name');
            $address = $request->input('address');

            $supplier_data = Supplier::where('id', $id)->first();

            if(!$supplier_data){

                return response()->json([
                    'message' => 'No supplier found'
    
                ],404);

            }

            $supplier_data->name = $name;
            $supplier_data->address = $address;
           
            $supplier_data->save();

            return response()->json([
                'message' => 'Data updated successfully'

            ],201);

        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }

     public function DeleteSupplier(Request $request, $id)
     {
         try {
 
             $data = Supplier::where('id', $id)->first();
 
             if (!$data) {
 
                 return response()->json([
                     'message' => 'No supplier data found'
 
                 ], 404);
 
             }
 
             Supplier::where('id', $id)->delete();
 
 
             return response()->json([
                 'message' => 'Data deleted successfully'
 
             ], 201);
 
         } catch (\Exception $error) {
             dd($error->getMessage());
 
         }
     }


}
