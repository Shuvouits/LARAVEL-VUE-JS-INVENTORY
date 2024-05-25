<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
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

     public function SupplierDetails($id){

        try{
            $purchase_data = Purchase::where('supplier_id', $id)->with('product')->orderBy('id', 'DESC')->get();
            $supplier_data = Supplier::where('id', $id)->first();

            $total_quantity = Purchase::where('supplier_id', $id)->sum('qty');
            $g_total = Purchase::where('supplier_id', $id)->sum('g_total');
            $p_amount = Purchase::where('supplier_id', $id)->sum('p_amount');
            $d_amount = Purchase::where('supplier_id', $id)->sum('d_amount');
    
            return response()->json([
                'purchase_data' => $purchase_data,
                'supplier_data' => $supplier_data,
                'total_quantity' => $total_quantity,
                'g_total' => $g_total,
                'p_amount' => $p_amount,
                'd_amount' => $d_amount
            ], 201);

        }catch (\Exception $error) {
            dd($error->getMessage());

        }
    }


}
