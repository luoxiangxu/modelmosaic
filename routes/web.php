<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified']);

Route::get('/about_me', function () {
    return view('user.about_me');
});

Route::get('/add_new_model', function () {
    return view('admin.add_new_model');
})->middleware('administrator');

Route::post('/add_new_item', [App\Http\Controllers\ItemTableController::class, 'item_add'])->middleware('administrator');

Route::get('/item_detail/{data}', [App\Http\Controllers\ItemTableController::class, 'item_detail'])->name('item_detail');

Route::get('/logout',function(){ auth()->logout();return redirect('/');});

Auth::routes();
Auth::routes(['verify' => true]);


Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


