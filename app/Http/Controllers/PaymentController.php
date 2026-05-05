<?php

// 1. السطر الذي سألت عنه (تحديد مكان الكنترولر)
namespace App\Http\Controllers;

// 2. استدعاء المكتبات المطلوبة
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Booking;

class PaymentController extends Controller
{
    /**
     * إنشاء جلسة الدفع وتوجيه المستخدم لموقع Stripe
     */
    public function checkout($id)
    {
        // جلب المفتاح السري من ملف .env
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // البحث عن الحجز أو إظهار خطأ 404 إذا لم يوجد
        $booking = Booking::findOrFail($id);

        // بناء جلسة الدفع
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'تأكيد حجز: ' . $booking->name,
                    ],
                    'unit_amount' => $booking->amount * 100, // تحويل المبلغ لسنتات
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', $booking->id),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    /**
     * ما يحدث بعد نجاح الدفع
     */
    public function success($id)
    {
        $booking = Booking::findOrFail($id);
        
        // تحديث حالة الحجز في قاعدة البيانات
        $booking->update([
            'payment_status' => 'paid'
        ]);

        // العودة لصفحة الحجوزات مع رسالة نجاح
        return redirect()->route('bookings.index')->with('success', 'تم الدفع بنجاح يا عبدالله، حجزك الآن مؤكد!');
    }

    /**
     * ما يحدث في حال إلغاء الدفع
     */
    public function cancel()
    {
        return redirect()->route('bookings.index')->with('error', 'تم إلغاء عملية الدفع.');
    }
}