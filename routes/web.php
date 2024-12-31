<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;

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
    Route::get('/investments-plans', 'investmentsPlansPage')->name('investments-plans');
    Route::get('/faqs', 'faqsPage')->name('faqs');
    Route::get('/about-us', 'aboutUsPage')->name('about-us');
    Route::get('/contact-us', 'contactUsPage')->name('contact-us');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'forceVerification'])->group(function () {

    Route::get('/user/email/update', [UserController::class, 'updateEmailView'])->middleware('isupdated')->withoutMiddleware('forceVerification')->name('email.update');
    Route::post('/user/email/update', [UserController::class, 'updateEmail'])->middleware('isupdated')->withoutMiddleware('forceVerification');
    Route::get('/user/profile/update', [UserController::class, 'updateProfile'])->middleware('isupdated')->name('profile.update');

    Route::middleware(['updated', 'mustHaveWallet'])->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::controller(AdminController::class)->middleware('admin')->group(function () {
            Route::get('/users', 'getAllUsers')->name('users');
            Route::get('/user/{id}/profiles', 'getUser')->name('user');
            Route::get('/investments', 'investments')->name('investments');
            Route::get('/transaction', 'transaction')->name('transaction');
            Route::get('/profile', 'profile')->name('profile');
            Route::get('/settings', 'settings')->name('settings');
        });

        Route::controller(UserController::class)->middleware('user')->group(function () {
            Route::get('/checkins', 'checkins')->name('checkins');
            Route::get('/wallet', 'wallet')->name('wallet');
            Route::get('/transactions', 'transactions')->name('transactions');
        });
    });
});
