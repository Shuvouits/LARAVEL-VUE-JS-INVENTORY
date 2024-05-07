<?php

use App\Http\Controllers\AuthController;
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


Route::get('/all-category', [CategoryController::class, 'AllCategory']);

Route::middleware('credential')->group(function () {
    
    Route::post('/setting', [AuthController::class, 'Setting']);
    Route::post('/profile-update', [AuthController::class, 'ProfileUpdate']);
    Route::post('/profile-setting', [AuthController::class, 'ProfileSetting']);
    Route::post('/add-category', [CategoryController::class, 'AddCategory']);
   
});
