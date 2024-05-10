<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
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
Route::post('/shuvo', [BrandController::class, 'TestBrand']);




Route::middleware('credential')->group(function () {
    
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
   
   
});