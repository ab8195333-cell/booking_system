<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. مسارات نظام الدخول والخروج (تأكد من وجود هذا السطر)
Auth::routes();

// 2. الصفحة الرئيسية: تحول المستخدم تلقائياً لجدول الحجوزات
Route::get('/', function () {
    return redirect()->route('bookings.index');
});

// 3. مسارات الحجوزات (المحمية: فقط للمسجلين)
Route::middleware(['auth'])->group(function () {
    Route::resource('bookings', BookingController::class);
    
    // مسارات الدفع
    Route::get('/payment/checkout/{id}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success/{id}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});