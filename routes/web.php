<?php

use Illuminate\Support\Facades\Route;

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
})->name('welcome');

Route::get('/features', function () {
    return view('features');
})->name('features');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Auth::routes();

Route::get('/account', [App\Http\Controllers\AccountController::class, 'show'])->name('account.show');
Route::get('/account/edit', [App\Http\Controllers\AccountController::class, 'edit'])->name('account.edit');
Route::put('/account/edit', [App\Http\Controllers\AccountController::class, 'update'])->name('account.edit');
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
