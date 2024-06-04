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

            $product = Product::where('id',$product_id)->first();

            if($product->quantity > $quantity){

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

            }else{
                return response()->json(['message' => 'Your Product is Out of stock'], 401);

            }


           




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

            $sales = Sale::where('return_qty', '>', 0)->with('product', 'customer')->orderBy('id', 'DESC')->get();
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

            $sale = Sale::where('id', $id)->with('product','customer')->first();

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

    public function UpdateReturn(Request $request, $id){
        try{

            $quantity = $request->input('quantity');

            $sale_product = Sale::where('id', $id)->first();

            $product_id = $sale_product->product_id;

            if(!$sale_product){
                return response()->json(['message' => 'Sales Product not found'], 401);
            }

            if($sale_product->quantity < $quantity){
                return response()->json(['message' => 'Product quantity is not appropriate'], 401);

            }

             //Update Product

             $product = Product::where('id', $product_id)->first();
             $product->quantity = $product->quantity + $quantity;
             $product->save();

            //update purchase

            $sale_product->quantity = $sale_product->quantity - $quantity;
            $sale_product->return_qty = $quantity;
            $sale_product->save();

           

            return response()->json(['message' => 'Product return successfully'], 201);


            
        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }



}
