<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SharedDocumentController;
use App\Http\Controllers\SharedUserController;
use App\Http\Controllers\StripeWebhookController;
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

    Route::resource('products', ProductController::class)->names([
        'index' => 'products.index',
        'create' => 'products.create',
        'store' => 'products.store',
        'edit' => 'products.edit',
        'update' => 'products.update',
        'destroy' => 'products.destroy',
    ]);


    // Soft delete and restore routes
    Route::prefix('users')->group(function () {
        Route::get('trashed', [UserController::class, 'trashed'])->name('users.trashed');
        Route::post('{user}/restore', [UserController::class, 'restore'])->name('users.restore');
        Route::delete('{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
    });
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');

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
    Route::post('/upload-document', [DocumentController::class, 'uploadDocument'])->name('upload.document');
    Route::get('/view-document/{document}', [DocumentController::class, 'viewDocument'])->name('view.document');
    Route::get('/remove-document/{document}', [DocumentController::class, 'removeDocument'])->name('remove.document');

    Route::get('shared-users', [SharedUserController::class, 'index'])->name('shared.users.index');
    Route::post('shared-users/invite', [SharedUserController::class, 'sendInvite'])->name('shared.users.invite');
    Route::post('shared-users/remove-document-access/{user}', [SharedUserController::class, 'removeDocumentAccess'])->name('remove.document.access');
    Route::get('choose-your-plan', [SubscriptionController::class, 'chooseYourPlan'])->name('subscriptions.index');
    Route::get('subscribe/{product}', [SubscriptionController::class, 'getCard'])->name('subscriptions.card');
    Route::post('subscribe/{product}', [SubscriptionController::class, 'subscribe'])->name('subscriptions.subscribe');
});
//** End Client Routes */

//** Professional Routes */
Route::group(['middleware' => ['auth', 'role:' . User::ROLE_PROFESSIONAL]], function () {
    Route::get('clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('client/{client_id}/documents', [ClientController::class, 'documents'])->name('client.documents');
    Route::get('client/document/{document}/show', [ClientController::class, 'show'])->name('client.document.show');
});
//** End Professional Routes */

//** User Routes */
Route::group(['middleware' => ['auth', 'role:' . User::ROLE_USER . '|' . User::ROLE_PROFESSIONAL]], function () {
    // Shared Document Routes
    Route::get('shared-documents', [SharedDocumentController::class, 'index'])->name('shared.documents.index');
    Route::get('shared-documents/{document}', [SharedDocumentController::class, 'show'])->name('shared.documents.show');
    Route::get('/view-shared-document/{document}', [SharedDocumentController::class, 'viewSharedDocument'])->name('view.shared.document');
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
    Route::get('invoices/{invoice}/pay', [InvoiceController::class, 'getCard'])->name('invoices.card');
    Route::post('invoices/{invoice}/pay', [InvoiceController::class, 'pay'])->name('invoices.pay');
    Route::get('invoice/{invoice}/download', [InvoiceController::class, 'downloadInvoice'])->name('invoices.download');
});

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);

require __DIR__ . '/auth.php';
