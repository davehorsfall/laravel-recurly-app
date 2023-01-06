<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
})->name('home');

Route::get('/features', function () {
    return view('features');
})->name('features');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Auth::routes();

Route::get('/account', [App\Http\Controllers\AccountController::class, 'show'])->name('account.show');
Route::get('/account/edit', [App\Http\Controllers\AccountController::class, 'edit'])->name('account.edit');
Route::put('/account/update', [App\Http\Controllers\AccountController::class, 'update'])->name('account.update');
Route::get('/account/password', [App\Http\Controllers\PasswordController::class, 'edit'])->middleware('password.confirm')->name('password.change');
Route::put('/account/password/update', [App\Http\Controllers\PasswordController::class, 'update'])->middleware('password.confirm')->name('password.update');

Route::get('/account/billing', [App\Http\Controllers\CashierController::class, 'billing'])->name('cashier.billing');
Route::post('/account/billing/update', [App\Http\Controllers\CashierController::class, 'update'])->name('cashier.update');



Route::get('/subscribe/{id}', [App\Http\Controllers\SubscribeController::class, 'checkout'])->name('subscribe');
Route::post('/subscribe/{id}', [App\Http\Controllers\SubscribeController::class, 'process'])->name('subscribe');


Route::resource('downloads', App\Http\Controllers\DownloadsController::class, ['except' => ['create', 'destroy', 'edit', 'store', 'update']]);
Route::resource('invoices', App\Http\Controllers\InvoicesController::class, ['except' => ['create', 'destroy', 'edit', 'store', 'update']]);
Route::resource('plans', App\Http\Controllers\PlansController::class, ['except' => ['create', 'destroy', 'edit', 'show', 'store', 'update']]);
Route::resource('subscriptions', App\Http\Controllers\SubscriptionsController::class);


Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {
    Route::resource('/users', UsersController::class, ['except' => ['create', 'show', 'store']]);
    Route::resource('/downloads', DownloadsController::class, ['except' => ['show']]);
});


Route::get('/subscription-checkout', function (Request $request) {
    return $request->user()
        ->newSubscription(env('STRIPE_PROD'), env('STRIPE_PRICE'))
        ->allowPromotionCodes()
        ->checkout([
            'success_url' => route('home'),
            'cancel_url' => route('home'),
        ]);
});