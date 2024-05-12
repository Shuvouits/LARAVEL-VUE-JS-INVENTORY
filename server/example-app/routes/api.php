<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/login', [AuthController::class, 'Login']);

//Route::post('/setting', [AuthController::class, 'Setting']);





Route::middleware(['credential', 'cors'])->group(function () {
    
    Route::post('/setting', [AuthController::class, 'Setting']);
    Route::post('/profile-update', [AuthController::class, 'ProfileUpdate']);
    Route::post('/profile-setting', [AuthController::class, 'ProfileSetting']);

    //category Route
    Route::post('/add-category', [CategoryController::class, 'AddCategory']);
    Route::get('/all-category', [CategoryController::class, 'AllCategory']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'EditCategory']);
    Route::post('/update-category/{id}', [CategoryController::class, 'UpdateCategory']);
    Route::get('/delete-category/{id}', [CategoryController::class, 'DeleteCategory']);
    Route::get('/update-category-status/{id}', [CategoryController::class, 'UpdateStatus']);

    //brand Route
    Route::post('/add-brand', [BrandController::class, 'AddBrand']);
    Route::get('/all-brand', [BrandController::class, 'AllBrand']);
    Route::get('/delete-brand/{id}', [BrandController::class, 'DeleteBrand']);
    Route::get('/update-brand-status/{id}', [BrandController::class, 'UpdateStatus']);
    Route::get('/brand/edit/{id}', [BrandController::class, 'EditBrand']);
    Route::post('/update-brand/{id}', [BrandController::class, 'UpdateBrand']);

    Route::post('/add-product', [ProductController::class, 'AddProduct']);
    Route::get('/all-product', [ProductController::class, 'AllProduct']);
    Route::get('/delete-product/{id}', [ProductController::class, 'DeleteProduct']);
    Route::get('/product/edit/{id}', [ProductController::class, 'EditProduct']);
    Route::post('/update-product/{id}', [ProductController::class, 'UpdateProduct']);
    Route::get('/expired-product', [ProductController::class, 'ExpiredProduct']);
    Route::get('/low-stock', [ProductController::class, 'LowStock']);
    Route::get('/out-stock', [ProductController::class, 'OutStock']);

    //Customer
    Route::post('/add-customer', [CustomerController::class, 'AddCustomer']);
    Route::get('/all-customer', [CustomerController::class, 'AllCustomer']);
    Route::get('/delete-customer/{id}', [CustomerController::class, 'DeleteCustomer']);
    Route::get('/customer/edit/{id}', [CustomerController::class, 'EditCustomer']);
    Route::post('/update-customer/{id}', [CustomerController::class, 'UpdateCustomer']);

    //Supplier
    Route::post('/add-supplier', [SupplierController::class, 'AddSupplier']);
    Route::get('/all-supplier', [SupplierController::class, 'AllSupplier']);
    Route::get('/delete-supplier/{id}', [SupplierController::class, 'DeleteSupplier']);
    Route::get('/supplier/edit/{id}', [SupplierController::class, 'EditSupplier']);
    Route::post('/update-supplier/{id}', [SupplierController::class, 'UpdateSupplier']);
   
   
});