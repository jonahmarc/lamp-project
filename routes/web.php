<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('form');
// });
Route::get('/', [CustomerController::class, 'form']);
Route::get('/review', [CustomerController::class, 'review']);
Route::get('/info', [CustomerController::class, 'info']);
Route::post('/save', [CustomerController::class, 'save']);
