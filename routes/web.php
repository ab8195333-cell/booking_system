<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. توجيه الرابط الرئيسي للموقع إلى قائمة الحجوزات مباشرة
Route::get('/', function () {
    return redirect()->route('bookings.index');
});

// 2. حل مشكلة (Route dashboard not defined) 
// هذا السطر يخبر لارافيل أنه في حال طلب النظام صفحة الـ dashboard، قم بتحويله فوراً إلى الحجوزات
Route::get('/dashboard', function () {
    return redirect()->route('bookings.index');
})->name('dashboard');

// 3. روابط نظام الحجوزات (عرض، إضافة، حفظ، حذف)
// تأكد أن BookingController موجود في مساره الصحيح
Route::resource('bookings', BookingController::class);

// 4. روابط المصادقة (إذا كنت تستخدم Breeze أو نظام تسجيل دخول)
// هذا السطر يترك للملفات التلقائية إدارة تسجيل الدخول
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}