<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'authenticate']);

//bank and account routes
Route::get('/getBank',[\App\Http\Controllers\BankController::class,'getData']);

Route::post('/saveAccount',[\App\Http\Controllers\AccountsController::class,'create']);
Route::post('/updateAccount/{id}',[\App\Http\Controllers\AccountsController::class,'update']);
Route::get('/getAccounts',[\App\Http\Controllers\AccountsController::class,'getData']);
Route::get('/getData/{id}',[\App\Http\Controllers\AccountsController::class,'getOneAccount']);
Route::get('/delete/{id}',[\App\Http\Controllers\AccountsController::class,'delete']);