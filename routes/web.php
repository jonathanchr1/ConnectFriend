<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;

Route::get('/', [FriendController::class, 'indexAll'])->name('welcome');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/payment', [PaymentController::class, 'index'])->middleware('auth');
Route::post('/payment', [PaymentController::class, 'store'])->middleware('auth');
Route::post('/payment/confirm-overpayment', [PaymentController::class, 'confirmOverpayment'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/user-home', function() {
        return view('userHome');
    })->name('userHome');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/topup', [TopUpController::class, 'index'])->name('topup.index');
    Route::post('/topup', [TopUpController::class, 'store'])->name('topup.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
    Route::get('/friends/list', [FriendController::class, 'list'])->name('friends.list');
    Route::get('/friends/{user}', [FriendController::class, 'show'])->name('friends.show');
    Route::post('/friends/request/{user}', [FriendController::class, 'sendRequest'])->name('friends.request');
    Route::post('/friends/accept/{friendRequest}', [FriendController::class, 'acceptRequest'])->name('friends.accept');
    Route::post('/friends/reject/{friendRequest}', [FriendController::class, 'rejectRequest'])->name('friends.reject');
    Route::delete('/friends/{user}', [FriendController::class, 'deleteFriend'])->name('friends.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/chat/{friend}', [MessageController::class, 'chat'])->name('messages.chat');
    Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send');
});

Route::get('/set-locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('set-locale');