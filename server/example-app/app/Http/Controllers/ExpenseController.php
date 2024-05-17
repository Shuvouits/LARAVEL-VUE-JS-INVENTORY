<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function AddCategoryExpense(Request $request){

        try{
            $name = $request->input('name');

        $expense_category = new ExpenseCategory();
        $expense_category->name = $name;
        $expense_category->save();

        return response()->json(['message'=> 'New expense category inserted'], 201);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

    }

    public function AllCategoryExpense(Request $request){

        try{
           $data = ExpenseCategory::all();
           return response()->json($data);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

    }

    public function DeleteExpense($id){
        try {
 
            $data = ExpenseCategory::where('id', $id)->first();

            if (!$data) {

                return response()->json([
                    'message' => 'No expense category data found'

                ], 404);

            }

            ExpenseCategory::where('id', $id)->delete();


            return response()->json([
                'message' => 'Data deleted successfully'

            ], 201);

        } catch (\Exception $error) {
            dd($error->getMessage());

        }
    }

    public function EditExpenseCategory(Request $request , $id){
        try{
            $data = ExpenseCategory::where('id', $id)->first();
            return response()->json([
                'name' => $data->name,

            ],201);

        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }

    public function UpdateCategoryExpense(Request $request , $id){
        try{

            $name = $request->input('name');

            $category_expense_data = ExpenseCategory::where('id', $id)->first();

            if(!$category_expense_data){

                return response()->json([
                    'message' => 'No category expense data found'
    
                ],404);

            }

            $category_expense_data->name = $name;
           
            $category_expense_data->save();

            return response()->json([
                'message' => 'Data updated successfully'

            ],201);

        }catch(\Exception $error){
            dd($error->getMessage());

        }
    }


}
