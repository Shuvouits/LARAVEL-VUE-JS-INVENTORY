<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Purchase;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardControlller extends Controller
{
   /* public function dashboard(){
        try{
            $currentDate = Carbon::now();
            $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
            $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();

            $total_product = Product::all()->count();
            $total_category = Category::all()->count();
    
            //$purchase_amount = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('g_total');
            $total_purchase = Purchase::sum('p_amount');
            $monthly_purchase = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('p_amount');

            $total_purchase_due = Purchase::sum('d_amount');
            $monthly_purchase_due = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('d_amount');
            //$purchase_paid = Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('p_amount');
    
           // $sales_amount = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('g_total');
           $total_sale = Sale::sum('p_amount');
           $monthly_sale = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('p_amount');

           $total_sale_due = Sale::sum('d_amount');
            $monthly_sales_due = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('d_amount');
           // $sales_paid = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('p_amount');
           
            $monthly_expense = Expense::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('amount');
            $total_expense = Expense::sum('amount');

            $total_customer = Customer::all()->count();
            $total_supplier = Supplier::all()->count();

            //Chart purpose calculation

            $currentYear = Carbon::now()->year;
            $monthlySales = [];

            for ($month = 1; $month <= 12; $month++) {
                // Format the start and end date for the month
                $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
                $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();
    
                // Query the sales table for the given month
                $sales = Sale::whereBetween('date', [$startDate, $endDate])->sum('g_total');
    
                // Add the sales data to the array
                $monthlySales[] = $sales;
            }

            $monthlyPurchase = [];

            for ($month = 1; $month <= 12; $month++) {
                // Format the start and end date for the month
                $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
                $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();
    
                // Query the sales table for the given month
                $purchase = Purchase::whereBetween('date', [$startDate, $endDate])->sum('g_total');
    
                // Add the sales data to the array
                $monthlyPurchase[] = $purchase;
            }

    

            $monthlyExpense = [];

            for ($month = 1; $month <= 12; $month++) {
                // Format the start and end date for the month
                $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
                $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();
            
                // Query the sales table for the given month
                $expense = Expense::whereBetween('date', [$startDate, $endDate])->sum('amount');
            
                // Add the expense data to the array
                $monthlyExpense[] = $expense; // Assign without specifying the key
            }
            



            
    
            return response()->json([
                //'purchase_amount' => $purchase_amount,
                //'sales_amount' => $sales_amount,
                //'expense_amount' => $expense_amount,
                'month_wise_sales' => $monthlySales,
                'month_wise_purchase' => $monthlyPurchase,
                'month_wise_expense' => $monthlyExpense,
                'total_category' => $total_category,
                'total_product' => $total_product,

                'total_purchase' => $total_purchase,
                'monthly_purchase' => $monthly_purchase,

                'total_sale' => $total_sale,
                'monthly_sale' => $monthly_sale,

                'total_sale_due' => $total_sale_due,
                'total_purchase_due' => $total_purchase_due,
                'monthly_sales_due' => $monthly_sales_due,
                'monthly_purchase_due' => $monthly_purchase_due,
                'monthly_expense' => $monthly_expense,
                'total_expense' => $total_expense,
               // 'purchase_paid' => $purchase_paid,
                //'sales_paid' => $sales_paid
                'total_customer' => $total_customer,
                'total_supplier' => $total_supplier
            ]);
    
        }catch(\Exception $error){
            dd($error->getMessage());
    
        }
    }  */


    public function dashboard(){
        try{
            $currentDate = Carbon::now();
            $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
            $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();
    
            $total_product = Product::all()->count();
            $total_category = Category::all()->count();
        
            $total_purchase = (int) Purchase::sum('p_amount');
            $monthly_purchase = (int) Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('p_amount');
    
            $total_purchase_due = (int) Purchase::sum('d_amount');
            $monthly_purchase_due = (int) Purchase::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('d_amount');
        
            $total_sale = (int) Sale::sum('p_amount');
            $monthly_sale = (int) Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('p_amount');
    
            $total_sale_due = (int) Sale::sum('d_amount');
            $monthly_sales_due = (int) Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('d_amount');
            
            $monthly_expense = (int) Expense::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('amount');
            $total_expense = (int) Expense::sum('amount');
    
            $total_customer = Customer::all()->count();
            $total_supplier = Supplier::all()->count();

            //$top_customer = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->with('customer')->orderBy('g_total', 'DESC')->limit(10)->get();
            $top_selling_product = Sale::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->groupBy('product_id')
            ->with('product')
            ->orderBy('total_quantity', 'DESC')
            ->limit(10)
            ->get();
        
    
            // Chart purpose calculation
            $currentYear = Carbon::now()->year;
            $monthlySales = [];
            $monthlyPurchase = [];
            $monthlyExpense = [];
    
            for ($month = 1; $month <= 12; $month++) {
                $startDate = Carbon::create($currentYear, $month, 1)->startOfMonth();
                $endDate = Carbon::create($currentYear, $month, 1)->endOfMonth();
        
                $sales = (int) Sale::whereBetween('date', [$startDate, $endDate])->sum('g_total');
                $monthlySales[] = $sales;
    
                $purchase = (int) Purchase::whereBetween('date', [$startDate, $endDate])->sum('g_total');
                $monthlyPurchase[] = $purchase;
    
                $expense = (int) Expense::whereBetween('date', [$startDate, $endDate])->sum('amount');
                $monthlyExpense[] = $expense;
            }
    
            return response()->json([
                'month_wise_sales' => $monthlySales,
                'month_wise_purchase' => $monthlyPurchase,
                'month_wise_expense' => $monthlyExpense,
                'total_category' => $total_category,
                'total_product' => $total_product,
                'total_purchase' => $total_purchase,
                'monthly_purchase' => $monthly_purchase,
                'total_sale' => $total_sale,
                'monthly_sale' => $monthly_sale,
                'total_sale_due' => $total_sale_due,
                'total_purchase_due' => $total_purchase_due,
                'monthly_sales_due' => $monthly_sales_due,
                'monthly_purchase_due' => $monthly_purchase_due,
                'monthly_expense' => $monthly_expense,
                'total_expense' => $total_expense,
                'total_customer' => $total_customer,
                'total_supplier' => $total_supplier,
                'top_selling_product' => $top_selling_product,
            ]);
    
        } catch(\Exception $error){
            dd($error->getMessage());
        }
    }

    public function HeaderInfo(){

        try{
            $currentDate = Carbon::now();
            $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
            $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();
    
            $top_customer = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->with('customer')->orderBy('g_total', 'DESC')->limit(10)->get();
            $out_of_stock = Product::where('quantity', 0)->get();

            return response()->json([
                
                'top_customer' => $top_customer,
                'out_of_stock' => $out_of_stock
            ], 201);


        }catch(\Exception $error){
            dd($error->getMessage());

        }

      

    }
    
}
