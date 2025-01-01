<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\UserPermissionController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// In routes/web.php or routes/api.php

// Route::group(['middleware' => ['auth', 'role:' . User::ROLE_ADMIN]], function () {
//     Route::resource('users', UserController::class);
//     Route::resource('invoices', InvoiceController::class);
//     Route::resource('documents', DocumentController::class);

//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     Route::get('/activity-logs', ActivityLogController::class);
// });

// Route::group(['middleware' => ['auth', 'role:' . User::ROLE_PROFESSIONAL]], function () {

//     Route::get('clients', [ClientController::class, 'index'])->name('clients.index'); // View Clients

//     // Invoice Routes
//     Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index'); // View invoices
//     Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show'); // View specific invoice
//     Route::post('invoices/{invoice}/pay', [InvoiceController::class, 'pay'])->name('invoices.pay'); // Pay invoice
// });

Route::group(['middleware' => ['auth', 'role:' . User::ROLE_CLIENT]], function () {

});





Route::get('file-upload', [FileManagerController::class, 'index'])->name('file.upload');


//document

Route::resource('document', DocumentController::class);
Route::delete('documents/{id}/delete', [DocumentController::class, 'fileDelete'])->name('documents.delete');

//User-manage

Route::resource('user-manage', UserManageController::class);
Route::delete('/user-manage/delete/{id}', [UserManageController::class, 'deleteUser'])->name('user-manage.delete');



Route::view('customer-invitation', 'document.customer-invitation');
Route::view('professional-invitation', 'document.professional-invitation');

Route::get('invite-user/{id}', [UserManageController::class, 'inviteuser'])->name('inviteUser');
Route::post('invite-user/{id}', [UserManageController::class, 'inviteUserRegister'])->name('inviteUserRegister');

Route::get('invite-professional/{id}', [UserManageController::class, 'inviteprofessional'])->name('inviteProfessional');
Route::post('invite-professional/{id}', [UserManageController::class, 'invitProfessionalRegister'])->name('invitProfessionalRegister');


//user-permission
Route::resource('permissions', UserPermissionController::class);

// Upgrade your plan
Route::resource('subscriptions', SubscriptionController::class);

require __DIR__ . '/auth.php';
