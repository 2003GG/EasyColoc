<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DepenseController;

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/colocation', function () {
    return view('colocation');
});

Route::get('/admin', [AdminController::class,'index'])->name('users.index');

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::put('/admin/{user}/banne',[AdminController::class,'bannie'])->name('user.banne');
Route::put('/admin/{user}/Inbannie',[AdminController::class,'Inbannie'])->name('user.Inbannie');
Route::get('/dashboard',[DepenseController::class,'store'])->name('depense.store');
Route::post('/dashboard',[DepenseController::class,'index'])->name('depense.index');



