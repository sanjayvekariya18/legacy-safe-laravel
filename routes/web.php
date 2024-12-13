<?php

use App\Models\User;
use App\Livewire\FileManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserPermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// In routes/web.php or routes/api.php

// Route::group(['middleware' => ['auth','role:'.User::ROLE_ADMIN]], function () {
//     Route::resource('users', UserController::class);
//     Route::resource('invoices', InvoiceController::class);
//     Route::resource('documents', DocumentController::class);

//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     Route::get('/activity-logs', ActivityLogController::class);
// });0

// Route::group(['middleware' => ['auth','role:'.User::ROLE_PROFESSIONAL]], function () {

//     Route::get('clients', [ClientController::class, 'index'])->name('clients.index'); // View Clients

//     // Invoice Routes
//     Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index'); // View invoices
//     Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show'); // View specific invoice
//     Route::post('invoices/{invoice}/pay', [InvoiceController::class, 'pay'])->name('invoices.pay'); // Pay invoice
// });

Route::group(['middleware' => ['auth', 'role:' . User::ROLE_CLIENT]], function () {
    //  Route::get('sharedUsers', [SharedUserController::class, 'index'])->name('sharedUsers.index'); // View Shared Users
});



//file Manager

// Route::post('file-upload', function () {
//     return view('document.file_manager');
// })->name('file.upload');








//document

Route::resource('document', DocumentController::class);
Route::delete('documents/{id}/delete', [DocumentController::class, 'fileDelete'])->name('documents.delete');

//User-manage

Route::resource('user-manage', UserManageController::class);
Route::delete('/user-manage/delete/{id}', [UserManageController::class, 'deleteUser'])->name('user-manage.delete');
Route::view('invition', 'document.invitation');


//user-permission
Route::resource('permissions', UserPermissionController::class);

// Upgrade your plan
Route::resource('subscriptions', SubscriptionController::class);




require __DIR__ . '/auth.php';
