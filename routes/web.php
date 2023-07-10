<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RazorpayController;

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

Route::get('payment',[RazorpayController::class,'formPage'])->name('payment');
Route::post('make-order',[RazorpayController::class,'makeOrder'])->name('make.order');
Route::get('success',[RazorpayController::class,'success'])->name('success');
 
