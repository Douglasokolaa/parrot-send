<?php

use App\Http\Controllers\DirectMessageController;
use App\Http\Controllers\PhonebookContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhonebookController;
use App\Http\Controllers\PhonebookImportController;
use App\Http\Controllers\SenderController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('phonebooks', PhonebookController::class);
    Route::resource('phonebooks.contacts', PhonebookContactController::class)->shallow();
    Route::post('/phonebooks/{phonebook}/import', PhonebookImportController::class)->name('phonebooks.import');

    Route::post('/messages/direct', [DirectMessageController::class, 'store'])->name('messages.direct.store');

    Route::resource('senders', SenderController::class);
});
