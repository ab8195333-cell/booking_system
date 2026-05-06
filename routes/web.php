<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| هنا يتم تسجيل جميع مسارات الويب الخاصة بمشروعك.
|
*/

// 1. الصفحة الرئيسية للموقع
Route::get('/', function () {
    return view('welcome');
});

// 2. مسارات المصادقة (تسجيل الدخول، التسجيل، الخروج)
Auth::routes();

// 3. مسارات الحجوزات (تطلب تسجيل الدخول)
// تشمل: index, create, store, edit, update, destroy
Route::resource('bookings', BookingController::class)->middleware('auth');

// 4. مسارات الدفع عبر Stripe
Route::middleware(['auth'])->group(function () {
    
    // صفحة الدفع الخاصة بكل حجز
    Route::get('/payment/{id}', [PaymentController::class, 'payment'])->name('stripe.payment');
    
    // معالجة عملية الدفع وتحديث الحالة
    Route::post('/stripe-payment', [PaymentController::class, 'postPayment'])->name('stripe.post');
    
});

// 5. صفحة الـ Dashboard الافتراضية (اختياري)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');