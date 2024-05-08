<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/about_me', function () {
    return view('user.about_me');
});

Route::get('/search_model', function () {
    return view('user.search_model');
});

Route::get('/purchase_record', function () {
    return view('user.purchase_record');
})->name('purchase_record');


Route::get('/add_new_model', function () {
    return view('admin.add_new_model');
})->middleware('administrator');

Route::get('/edit_model', function () {
    return view('admin.edit_model');
})->middleware('administrator');

Route::get('/get_items', [App\Http\Controllers\ItemTableController::class, 'get_items'])->middleware('administrator');

Route::get('/get_purchase_record', [App\Http\Controllers\PurchaseRecordController::class, 'get_purchase_record']);

Route::get('/user/get_items', [App\Http\Controllers\ItemTableController::class, 'user_get_items']);

Route::get('/search_item', [App\Http\Controllers\ItemTableController::class, 'search_item'])->middleware('administrator');

Route::get('/user/search_purchase_record', [App\Http\Controllers\PurchaseRecordController::class, 'user_search_purchase_record']);

Route::get('/user/search_item', [App\Http\Controllers\ItemTableController::class, 'user_search_item']);

Route::post('/add_new_item', [App\Http\Controllers\ItemTableController::class, 'item_add'])->middleware('administrator');

Route::post('/delete_item', [App\Http\Controllers\ItemTableController::class, 'item_delete'])->middleware('administrator');

Route::post('/restore_item', [App\Http\Controllers\ItemTableController::class, 'item_restore'])->middleware('administrator');

Route::post('/edit_item', [App\Http\Controllers\ItemTableController::class, 'edit_item'])->middleware('administrator');

Route::get('/item_detail/{data}', [App\Http\Controllers\ItemTableController::class, 'item_detail'])->name('item_detail');

Route::get('/logout',function(){ auth()->logout();return redirect('/');});

Route::get('/stripe/{id}', [App\Http\Controllers\StripeController::class, 'stripe'])->middleware(['auth', 'verified'])->name('stripe');

Route::get('/success', [App\Http\Controllers\StripeController::class, 'success'])->name('success');

Route::get('/cancel', [App\Http\Controllers\StripeController::class, 'cancel'])->name('cancel');

Route::get('/get_comments', [App\Http\Controllers\UserCommentTableController::class, 'get_comments']);

Route::post('/post_comment', [App\Http\Controllers\UserCommentTableController::class, 'post_comment'])->middleware(['auth', 'verified']);

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


