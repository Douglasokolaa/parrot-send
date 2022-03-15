<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PhonebookContactController;
use App\Http\Controllers\PhoneBookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SenderController;
use Illuminate\Support\Facades\Route;
use Parrot\Sms\SmsProvider;
use Parrot\Sms\Termii;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('phonebooks', PhoneBookController::class)->except(['store', 'update']);
    Route::resource('contacts', ContactController::class)->except(['store', 'update', 'index']);
    Route::resource('senders', SenderController::class)->except(['store', 'update']);

    Route::controller(PhonebookContactController::class)->group(function () {
        Route::get('phonebooks/{phonebook}/contacts', 'index')->name('phonebooks.contacts.index');
    });
});

});
