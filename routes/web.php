<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\poductController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create',[poductController::class, 'create'])->name('create');
Route::get('/index',[poductController::class, 'index'])->name('index');
Route::post('/store',[poductController::class,'store'])->name('store');
Route::get('/edit/{id}',[poductController::class, 'edit'])->name('edit');
Route::put('/update/{id}',[poductController::class, 'update'])->name('update');
Route::get('/delete/{id}',[poductController::class, 'delete'])->name('delete');
