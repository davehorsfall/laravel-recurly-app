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
});

Auth::routes();

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile');

Route::resource('downloads', App\Http\Controllers\DownloadsController::class, ['except' => ['create', 'destroy', 'edit', 'store', 'update']]);
Route::resource('invoices', App\Http\Controllers\InvoicesController::class, ['except' => ['create', 'destroy', 'edit', 'store', 'update']]);
Route::resource('plans', App\Http\Controllers\PlansController::class, ['except' => ['create', 'destroy', 'edit', 'store', 'update']]);
Route::resource('subscriptions', App\Http\Controllers\SubscriptionsController::class);

Route::get('/subscribe/{id}', [App\Http\Controllers\SubscribeController::class, 'checkout'])->name('subscribe');
Route::post('/subscribe/{id}', [App\Http\Controllers\SubscribeController::class, 'process'])->name('subscribe');

Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {
    Route::resource('/users', UsersController::class, ['except' => ['create', 'show', 'store']]);
    Route::resource('/downloads', DownloadsController::class, ['except' => ['show']]);
});
