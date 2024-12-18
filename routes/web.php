<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(GuestController::class)->group(function () {
    Route::get('/', 'homePage')->name('home');
    Route::get('/results', 'resultPage')->name('results');
    Route::get('/contact-us', 'contactUsPage')->name('contact-us');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'forceVerification'])->group(function () {

    Route::get('/user/profile/update', [UserController::class, 'updateProfile'])->middleware('isupdated')->name('profile.update');

    Route::middleware('updated')->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::controller(AdminController::class)->middleware('admin')->group(function () {
            Route::get('/users', 'getAllUsers')->name('users');
            Route::get('/games', 'getAllGames')->name('games');
            Route::get('/game/{game}', 'getAllTickets')->name('game');
            Route::get('/ticket/{ticket}', 'getTicket')->name('ticket');
            Route::get('/transaction', 'transaction')->name('transaction');
            Route::get('/winners', 'winners')->name('winners');
        });

        Route::controller(UserController::class)->middleware('user')->group(function () {
            Route::get('/tickets', 'getAllTickets')->name('user.tickets');
            Route::get('/myticket', 'getUserTickets')->name('user.myticket');
            Route::get('/history', 'getUserHistory')->name('user.history');
            Route::get('/wallet', 'getUserWallet')->name('user.wallet');
        });
    });
});
