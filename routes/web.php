<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SharedUserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// In routes/web.php or routes/api.php
Route::group(['middleware' => ['auth','role:'.User::ROLE_ADMIN]], function () {
    Route::resource('users', UserController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('documents', DocumentController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth','role:'.User::ROLE_PROFESSIONAL]], function () {

    Route::get('clients', [ClientController::class, 'index'])->name('clients.index'); // View Clients

    // Invoice Routes
    Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index'); // View invoices
    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show'); // View specific invoice
    Route::post('invoices/{invoice}/pay', [InvoiceController::class, 'pay'])->name('invoices.pay'); // Pay invoice
});

Route::group(['middleware' => ['auth','role:'.User::ROLE_CUSTOMER]], function () {
    Route::resource('documents', DocumentController::class);
    Route::get('plans', [SubscriptionController::class, 'index'])->name('plans.index'); // View Shared Users
    Route::get('sharedUsers', [SharedUserController::class, 'index'])->name('sharedUsers.index'); // View Shared Users
});

require __DIR__.'/auth.php';
