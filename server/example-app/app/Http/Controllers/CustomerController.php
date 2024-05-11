<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function AddCustomer(Request $request){

        $name = $request->input('name');
        $address = $request->input('address');

        $customer = new Customer();
        $customer->name = $name;
        $customer->address = $address;
        $customer->save();

        return response()->json(['message' => "New customer inserted"]);

    }

    public function AllCustomer(Request $request){

       $customer = Customer::all();

        return response()->json($customer);

    }

    public function DeleteCustomer(Request $request, $id)
    {
        try {

            $data = Customer::where('id', $id)->first();

            if (!$data) {

                return response()->json([
                    'message' => 'No brand data found'

                ], 404);

            }

            Customer::where('id', $id)->delete();


            return response()->json([
                'message' => 'Data deleted successfully'

            ], 201);

        } catch (\Exception $error) {
            dd($error->getMessage());

        }
    }


}
