<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\ProfileController;
use App\Models\Invitation;
use App\Models\Payement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\CategorieController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin', [AdminController::class, 'index'])->name('users.index');
    Route::put('/admin/{user}/banne', [AdminController::class, 'bannie'])->name('user.banne');
    Route::put('/admin/{user}/Inbannie', [AdminController::class, 'Inbannie'])->name('user.Inbannie');
    Route::get('/colocation',[ColocationController::class,'index'])->name('colocation.index');
    Route::get('/invitation',[InvitationController::class,'index'])->name('invitation.index');
    Route::get('/dashboard', [DepenseController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DepenseController::class, 'store'])->name('depense.store');
    Route::post('/colocation',[ColocationController::class,'store'])->name('colocation.store');
    Route::put('/invitation/{userInvitation}/accept/{colocationId}',[InvitationController::class,'acceptInvitation'])->name('accept.invitation');
    Route::put('/invitation/{userInvitation}/refuse',[InvitationController::class,'refuseInvitation'])->name('refuser.invitation');
    Route::get('/categorie',[CategorieController::class,'index'])->name('categorie.index');
    Route::post('/categorie',[CategorieController::class,'store'])->name('categorie.store');
    Route::post('/invitation',[InvitationController::class,'sendInvitisation'])->name('invitation.send');
    Route::get('/payements',[PayementController::class,'index'])->name('payement.index');
    Route::get('/payements/{payementId}/paid',[PayementController::class,'Paid'])->name('payement.paid');
    Route::put('/colocation/cancel',[ColocationController::class,'cancel'])->name('cancel.colocation');

});

require __DIR__.'/auth.php';
