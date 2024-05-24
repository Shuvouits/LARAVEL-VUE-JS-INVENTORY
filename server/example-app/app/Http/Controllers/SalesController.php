<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function AddSales(Request $request)
    {


        try {

            $customer_id = $request->input('customer_id');
            $product_id = $request->input('product_id');
            $date = $request->input('date');
            $quantity = $request->input('quantity');
            $g_total = $request->input('g_total');
            $p_amount = $request->input('p_amount');
            $d_amount = $request->input('d_amount');
            $status = $request->input('status');


            $sale = new Sale();
            $sale->customer_id = $customer_id;
            $sale->product_id = $product_id;
            $sale->quantity = $quantity;
            $sale->g_total = $g_total;
            $sale->date = $date;
            $sale->p_amount = $p_amount;
            $sale->d_amount = $d_amount;
            $sale->status = $status;
            $sale->save();

            //update product quantity
            $product = Product::where('id', $product_id)->first();
            $product->quantity = $product->quantity - $quantity;
            $product->save();



            return response()->json(['message' => 'Data inserted successfully'], 201);




        } catch (\Exception $error) {
            dd($error->getMessage());
        }



    }

    public function AllSales(Request $request)
    {

        try {

            $sales = Sale::with('product', 'customer')->orderBy('id', 'DESC')->get();
            return response()->json($sales);

        } catch (\Exception $error) {
            dd($error->getMessage());
        }

    }

    public function AllSalesReturn(Request $request)
    {

        try {

            $sales = Sale::where('status', 'Return')->with('product', 'customer')->orderBy('id', 'DESC')->get();
            return response()->json($sales);

        } catch (\Exception $error) {
            dd($error->getMessage());
        }

    }

    public function DeleteSales($id)
    {
        try {

            $data = Sale::where('id', $id)->first();

            //product add to the stock
            $product = Product::where('id', $data->product_id)->first();
            $product->quantity = $product->quantity + $data->quantity;
            $product->save();

            if (!$data) {

                return response()->json([
                    'message' => 'No product data found'

                ], 404);

            }

            Sale::where('id', $id)->delete();


            return response()->json([
                'message' => 'Data deleted successfully'

            ], 201);

        } catch (\Exception $error) {
            dd($error->getMessage());

        }
    }

    public function EditSales(Request $request, $id)
    {


        try {

            $sale = Sale::where('id', $id)->first();

            return response()->json($sale);


        } catch (\Exception $error) {
            dd($error->getMessage());
        }



    }

    public function UpdateSales(Request $request, $id)
    {


        try {

            $customer_id = $request->input('customer_id');
            $product_id = $request->input('product_id');
            $date = $request->input('date');
            $quantity = $request->input('quantity');


            $g_total = $request->input('g_total');
            $p_amount = $request->input('p_amount');
            $d_amount = $request->input('d_amount');

            $status = $request->input('status');

            $sale = Sale::where('id', $id)->first();

            //stock Product manage

            if ($sale->quanity < $quantity) {
                $product = Product::where('id', $product_id)->first();
                
                $product->quantity = $product->quantity - ($quantity - $sale->quantity);
                $product->save();
            } else {
                $product = Product::where('id', $product_id)->first();
                $product->quantity = $product->quantity + ($sale->quantity - $quantity);
                $product->save();

            }

            if($status == 'Return'){
                $product = Product::where('id', $product_id)->first();
                
                $product->quantity = $product->quantity + ($quantity);
                $product->save();

            }

            //end


              $sale->customer_id = $customer_id;
              $sale->product_id = $product_id;
              $sale->quantity = $quantity;
              $sale->g_total = $g_total;
              $sale->date = $date;
              $sale->p_amount = $p_amount;
              $sale->d_amount = $d_amount;
              $sale->status = $status; 
              $sale->save();

           




            return response()->json(['message' => 'Data updated successfully'], 201);




        } catch (\Exception $error) {
            dd($error->getMessage());
        }



    }



}
