<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SharedDocumentController;
use App\Http\Controllers\SharedUserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard'); // View Shared Users


// In routes/web.php or routes/api.php
//** Admin Routes */
Route::group(['middleware' => ['auth', 'role:' . User::ROLE_ADMIN]], function () {
    Route::resource('users', UserController::class)->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'show' => 'users.show',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);
    Route::delete('users/{user}/soft-delete', [UserController::class, 'softDelete'])->name('users.soft-delete');
    Route::delete('users/{user}/hard-delete', [UserController::class, 'hardDelete'])->name('users.hard-delete');


    // Soft delete and restore routes
    Route::prefix('users')->group(function () {
        Route::get('trashed', [UserController::class, 'trashed'])->name('users.trashed');
        Route::post('{user}/restore', [UserController::class, 'restore'])->name('users.restore');
        Route::delete('{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
        Route::get('users/{user}/permissions/edit', [UserController::class, 'editUserPermission'])->name('users.edit.permission');
        Route::post('users/{user}/permissions/update', [UserController::class, 'updateUserPermission'])->name('users.update.permission');
    });

    Route::get('/activity-logs', ActivityLogController::class)->name('activity.logs');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//** End Admin Routes */

//** Client Routes */
Route::group(['middleware' => ['auth', 'role:' . User::ROLE_CLIENT]], function () {
    Route::resource('documents', DocumentController::class)->names([
        'index' => 'documents.index',
        'create' => 'documents.create',
        'store' => 'documents.store',
        'show' => 'documents.show',
        'edit' => 'documents.edit',
        'update' => 'documents.update',
        'destroy' => 'documents.destroy',
    ]);

    Route::get('shared-users', [SharedUserController::class, 'index'])->name('shared.users.index'); // View Shared Users
    Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index'); // View Subscription
});
//** End Client Routes */

//** Professional Routes */
Route::group(['middleware' => ['auth', 'role:' . User::ROLE_PROFESSIONAL]], function () {
    Route::get('clients', [ClientController::class, 'index'])->name('clients.index'); // View Clients
});
//** End Professional Routes */

//** User Routes */
Route::group(['middleware' => ['auth', 'role:' . User::ROLE_USER . '|' . User::ROLE_PROFESSIONAL]], function () {
    // Shared Document Routes
    Route::get('shared-documents', [SharedDocumentController::class, 'index'])->name('shared.documents.index'); // View invoices
});
//** End User Routes */


Route::group(['middleware' => 'auth'], function () {
    // Invoices Routes
    Route::resource('invoices', InvoiceController::class)->names(
        [
            'index' => 'invoices.index',
            'create' => 'invoices.create',
            'store' => 'invoices.store',
            'show' => 'invoices.show',
            'edit' => 'invoices.edit',
            'update' => 'invoices.update',
            'destroy' => 'invoices.destroy',
        ]
    )->except(['pay']);
    Route::get('invoices/{invoice}/pay', [InvoiceController::class, 'pay'])->name('invoices.pay');
});

require __DIR__ . '/auth.php';
