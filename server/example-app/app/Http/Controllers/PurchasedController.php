<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            $amount_per = $request->input('amount_per');

            $purchased = new Purchase();
            $purchased->supplier_id = $supplier_id;
            $purchased->product_id = $product_id;
            $purchased->qty = $qty;
            $purchased->status = $status;
            $purchased->date = $date;
            $purchased->g_total = $g_total;
            $purchased->p_amount = $p_amount;
            $purchased->d_amount = $d_amount;
            $purchased->amount_per = $amount_per;
            $purchased->save();

            //update product quantity
            if($status == 'Received'){
                $product = Product::where('id', $product_id)->first();
                $product->quantity = $product->quantity + $qty;
                $product->save();

            }
            


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
            $amount_per = $request->input('amount_per');

            $purchased = Purchase::where('id', $id)->first();
            $purchased->supplier_id = $supplier_id;
            $purchased->product_id = $product_id;
            $purchased->qty = $qty;
            $purchased->status = $status;
            $purchased->date = $date;
            $purchased->g_total = $g_total;
            $purchased->p_amount = $p_amount;
            $purchased->d_amount = $d_amount;
            $purchased->amount_per = $amount_per;
            $purchased->save();

            if($status == 'Received'){
                $product = Product::where('id', $product_id)->first();
                $product->quantity = $product->quantity + $qty;
                $product->save();

            }

            if($status == 'Return'){
                $product = Product::where('id', $product_id)->first();
                $product->quantity = $product->quantity - $qty;
                $product->save();

            }

            return response()->json(['message' => 'Data updated successfully'], 201);




        } catch (\Exception $error) {
            dd($error->getMessage());
        }



    }  

    public function DeletePurchased($id)
    {
        try {

            $data = Purchase::where('id', $id)->first();

            if($data->status == 'Received' || $data->status == 'Return'){

                $product = Product::where('id', $data->product_id)->first();
                $product->quantity = $product->quantity - $data->qty;
                $product->save();

            }

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

    public function PurchasedOrder()
    {

        try {

            $purchase = Purchase::orderBy('id', 'DESC')->where('status', 'Ordered')->with('supplier', 'product')->get();

            return response()->json($purchase);

        } catch (\Exception $error) {
            dd($error->getMessage());
        }



    } 

    public function PurchasedReceived()
    {

        try {

            $purchase = Purchase::orderBy('id', 'DESC')->where('status', 'Received')->with('supplier', 'product')->get();

            return response()->json($purchase);

        } catch (\Exception $error) {
            dd($error->getMessage());
        }



    } 

    public function PurchasedReturn()
    {

        try {

            $purchase = Purchase::orderBy('id', 'DESC')->where('return_qty', '>', 0)->with('supplier', 'product')->get();

            return response()->json($purchase);

        } catch (\Exception $error) {
            dd($error->getMessage());
        }



    } 

    public function UpdateReturn(Request $request, $id){
        try{

            $qty = $request->input('qty');

            $purchase_product = Purchase::where('id', $id)->first();

            $product_id = $purchase_product->product_id;

            if(!$purchase_product){
                return response()->json(['message' => 'Purchase Product not found'], 401);
            }

            if($purchase_product->qty < $qty){
                return response()->json(['message' => 'Product quantity is not appropriate'], 401);

            }

            //update purchase

            $purchase_product->qty = $purchase_product->qty - $qty;
            $purchase_product->return_qty = $qty;
            $purchase_product->save();

            //Update Product

            $product = Product::where('id', $product_id)->first();
            $product->quantity = $product->quantity - $qty;
            $product->save();

            return response()->json(['message' => 'Product return successfully'], 201);


            
        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }

}
