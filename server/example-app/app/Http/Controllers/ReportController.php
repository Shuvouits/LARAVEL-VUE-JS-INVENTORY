<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function SalesReport(){

        try{
            $currentDate = Carbon::now();
            $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
            $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();
            
            $sale = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->with('product','customer')->get();
            $total_quantity = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('quantity');
            $g_total = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('g_total');
            $p_amount = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('p_amount');
            $d_amount = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('d_amount');

            return response()->json([
                'sale' => $sale,
                'total_quantity' => $total_quantity,
                'g_total' => $g_total,
                'p_amount' => $p_amount,
                'd_amount' => $d_amount
            ]);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

      

    }

    public function SalesReportDate(Request $request){

        try{

           $start_date = $request->input('start_date');
           $end_date = $request->input('end_date');
            
            $sale = Sale::whereBetween('date', [$start_date, $end_date])->with('product','customer')->get();
            $total_quantity = Sale::whereBetween('date', [$start_date, $end_date])->sum('quantity');
            $g_total = Sale::whereBetween('date', [$start_date, $end_date])->sum('g_total');
            $p_amount = Sale::whereBetween('date', [$start_date, $end_date])->sum('p_amount');
            $d_amount = Sale::whereBetween('date', [$start_date, $end_date])->sum('d_amount');

            return response()->json([
                'message' => 'Custom filter success',
                'sale' => $sale,
                'total_quantity' => $total_quantity,
                'g_total' => $g_total,
                'p_amount' => $p_amount,
                'd_amount' => $d_amount
            ]);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

      

    }

    public function PurchaseReport(){

        try{
            $currentDate = Carbon::now();
            $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
            $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();
            
            $purchase = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->with('product','supplier')->get();
            $total_quantity = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('qty');
            $g_total = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('g_total');
            $p_amount = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('p_amount');
            $d_amount = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('d_amount');

            return response()->json([
                'purchase' => $purchase,
                'total_quantity' => $total_quantity,
                'g_total' => $g_total,
                'p_amount' => $p_amount,
                'd_amount' => $d_amount
            ]);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

      

    }

    public function PurchaseReportDate(Request $request){

        try{

           $start_date = $request->input('start_date');
           $end_date = $request->input('end_date');
            
            $purchase = Purchase::whereBetween('date', [$start_date, $end_date])->with('product','supplier')->get();
            $total_quantity = Purchase::whereBetween('date', [$start_date, $end_date])->sum('qty');
            $g_total = Purchase::whereBetween('date', [$start_date, $end_date])->sum('g_total');
            $p_amount = Purchase::whereBetween('date', [$start_date, $end_date])->sum('p_amount');
            $d_amount = Purchase::whereBetween('date', [$start_date, $end_date])->sum('d_amount');

            return response()->json([
                'message' => 'Custom filter success',
                'purchase' => $purchase,
                'total_quantity' => $total_quantity,
                'g_total' => $g_total,
                'p_amount' => $p_amount,
                'd_amount' => $d_amount
            ]);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

      

    }

    public function ExpenseReport(){

        try{
            $currentDate = Carbon::now();
            $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
            $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();
            
            $expense = Expense::whereBetween('date', [$startOfMonth, $endOfMonth])->with('expenseCategoryData')->get();
           
            $amount = Expense::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('amount');

            return response()->json([
                'expense' => $expense,
                'amount' => $amount
            ]);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

      

    }

    public function ExpenseReportDate(Request $request){

        try{

           $start_date = $request->input('start_date');
           $end_date = $request->input('end_date');
            
            $expense = Expense::whereBetween('date', [$start_date, $end_date])->with('expenseCategoryData')->get();
           
            $amount = Expense::whereBetween('date', [$start_date, $end_date])->sum('amount');

            return response()->json([
                'message' => 'Custom filter success',
                'expense' => $expense,
                'amount' => $amount
            ]);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

      

    }

    public function ProfitLossReport(){

        try{
            $currentDate = Carbon::now();
            $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
            $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();

            $purchase_amount = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('g_total');
            $purchase_due = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('d_amount');
            $purchase_paid = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('p_amount');

            $sales_amount = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('g_total');
            $sales_due = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('d_amount');
            $sales_paid = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('p_amount');
           
            $expense_amount = Expense::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('amount');

            return response()->json([
                'purchase_amount' => $purchase_amount,
                'sales_amount' => $sales_amount,
                'expense_amount' => $expense_amount,
                'sales_due' => $sales_due,
                'purchase_due' => $purchase_due,
                'purchase_paid' => $purchase_paid,
                'sales_paid' => $sales_paid
            ]);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

      

    }


    public function ProfitLossReportDate(Request $request){

        try{

            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

           $purchase_amount = Purchase::whereBetween('date', [$start_date, $end_date])->sum('g_total');
            $purchase_due = Purchase::whereBetween('date', [$start_date, $end_date])->sum('d_amount');
            $purchase_paid = Purchase::whereBetween('date', [$start_date, $end_date])->sum('p_amount');

            $sales_amount = Sale::whereBetween('date', [$start_date, $end_date])->sum('g_total');
            $sales_due = Sale::whereBetween('date', [$start_date, $end_date])->sum('d_amount');
            $sales_paid = Sale::whereBetween('date', [$start_date, $end_date])->sum('p_amount');
           
            $expense_amount = Expense::whereBetween('date', [$start_date, $end_date])->sum('amount');

            return response()->json([
                'message' => 'Custom filter success',
                'purchase_amount' => $purchase_amount,
                'sales_amount' => $sales_amount,
                'expense_amount' => $expense_amount,
                'sales_due' => $sales_due,
                'purchase_due' => $purchase_due,
                'purchase_paid' => $purchase_paid,
                'sales_paid' => $sales_paid
            ]);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

      

    }


}
