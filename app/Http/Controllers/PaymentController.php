<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // استدعاء المودل للتعامل مع قاعدة البيانات
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * عرض صفحة بوابة الدفع (التي تحتوي على حقول البطاقة)
     */
    public function payment($id)
    {
        // جلب بيانات الحجز أو إظهار خطأ 404 إذا لم يوجد
        $booking = Booking::findOrFail($id);

        // توجيه المستخدم لصفحة الدفع مع بيانات الحجز
        return view('stripe_payment', compact('booking'));
    }

    /**
     * معالجة عملية الدفع المباشرة من البطاقة
     * هذا الكود الذي طلبته تحديداً
     */
    public function postPayment(Request $request)
    {
        // 1. التحقق من وصول رقم الحجز في الطلب
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
        ]);

        // 2. العثور على الحجز المطلوب في قاعدة البيانات
        $booking = Booking::findOrFail($request->booking_id);
        
        // 3. تحديث حالة الحجز إلى "completed" (تم الدفع)
        // سيؤدي هذا لتغيير لون الزر في القائمة الرئيسية إلى الأخضر
        $booking->update([
            'status' => 'completed'
        ]);

        // 4. التوجيه إلى قائمة الحجوزات مع رسالة نجاح تظهر للمستخدم
        return redirect()->route('bookings.index')
                         ->with('success', 'تمت عملية الدفع بنجاح من البطاقة مباشرة للحجز رقم #' . $booking->id . ' ✅');
    }
}