<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchasedController extends Controller
{
    public function AddPurchased(Request $request)
    {


        try {

            $supplier_id = $request->input('supplier_id');
            $product_id = $request->input('product_id');
            $qty = $request->input('qty');
            $status = $request->input('status');
            $date = $request->input('date');
            $g_total = $request->input('g_total');
            $p_amount = $request->input('p_amount');
            $d_amount = $request->input('d_amount');

            $purchased = new Purchase();
            $purchased->supplier_id = $supplier_id;
            $purchased->product_id = $product_id;
            $purchased->qty = $qty;
            $purchased->status = $status;
            $purchased->date = $date;
            $purchased->g_total = $g_total;
            $purchased->p_amount = $p_amount;
            $purchased->d_amount = $d_amount;
            $purchased->save();

            return response()->json(['message' => 'Data inserted successfully'], 201);




        } catch (\Exception $error) {
            dd($error->getMessage());
        }



    }

    public function AllPurchased()
    {

        try {

            $purchase = Purchase::orderBy('id', 'DESC')->with('supplier', 'product')->get();

            return response()->json($purchase);

        } catch (\Exception $error) {
            dd($error->getMessage());
        }



    }  

    public function EditPurchased(Request $request, $id)
    {


        try {

            $purchased =  Purchase::where('id', $id)->first();
            
            return response()->json($purchased);


        } catch (\Exception $error) {
            dd($error->getMessage());
        }



    }

    public function UpdatePurchased(Request $request, $id)
    {


        try {

            $supplier_id = $request->input('supplier_id');
            $product_id = $request->input('product_id');
            $qty = $request->input('qty');
            $status = $request->input('status');
            $date = $request->input('date');
            $g_total = $request->input('g_total');
            $p_amount = $request->input('p_amount');
            $d_amount = $request->input('d_amount');

            $purchased = Purchase::where('id', $id)->first();
            $purchased->supplier_id = $supplier_id;
            $purchased->product_id = $product_id;
            $purchased->qty = $qty;
            $purchased->status = $status;
            $purchased->date = $date;
            $purchased->g_total = $g_total;
            $purchased->p_amount = $p_amount;
            $purchased->d_amount = $d_amount;
            $purchased->save();

            return response()->json(['message' => 'Data updated successfully'], 201);




        } catch (\Exception $error) {
            dd($error->getMessage());
        }



    }  

    public function DeletePurchased($id)
    {
        try {

            $data = Purchase::where('id', $id)->first();

            if (!$data) {

                return response()->json([
                    'message' => 'No purchase data found'

                ], 404);

            }

            Purchase::where('id', $id)->delete();


            return response()->json([
                'message' => 'Data deleted successfully'

            ], 201);

        } catch (\Exception $error) {
            dd($error->getMessage());

        }
    }

}
