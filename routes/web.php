<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransactionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[LoginController::class,'login']);
Route::post('login',[LoginController::class,'login_user']);
Route::get('register',[LoginController::class,'register']);
Route::post('register',[LoginController::class,'register_store']);


Route::group(['middleware' => 'auth'], function () {

Route::get('home',[TransactionController::class,'home']);
Route::get('deposit',[TransactionController::class,'deposit']);
Route::post('deposit',[TransactionController::class,'deposit_amount']);

Route::get('withdraw',[TransactionController::class,'withdraw']);
Route::post('withdraw',[TransactionController::class,'withdraw_amount']);

Route::get('transfer',[TransactionController::class,'transfer']);
Route::post('transfer',[TransactionController::class,'transfer_amount']);

Route::get('statements',[TransactionController::class,'statements']);
Route::get('logout',[LoginController::class,'logout']);

});
