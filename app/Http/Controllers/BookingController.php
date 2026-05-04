<?php

namespace App\Http\Controllers;

// استدعاء الموديل والطلب - ضروري جداً لكي يعمل الجدول
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * دالة العرض: تجلب البيانات من قاعدة البيانات وتظهرها في الجدول
     */
    public function index()
    {
        // جلب البيانات وترتيبها من الأحدث (لكي يظهر الحجز الجديد في أول الصفوف)
        $bookings = Booking::latest()->get(); 
        
        // إرسال البيانات لملف index.blade.php
        return view('bookings.index', compact('bookings'));
    }

    /**
     * دالة الإضافة: تفتح لك الصفحة التي فيها المربعات (الاسم، الايميل، التاريخ)
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * دالة الحفظ: تأخذ البيانات من المربعات وتخزنها في MySQL ثم تنقلك للجدول
     */
    public function store(Request $request)
    {
        // 1. التأكد من أن المستخدم أدخل بيانات صحيحة
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'booking_date' => 'required|date',
        ]);

        // 2. أمر الحفظ الفعلي في قاعدة البيانات
        Booking::create($request->all());

        // 3. أهم خطوة: التوجيه لصفحة الـ index (الجدول) مع رسالة تأكيد
        return redirect()->route('bookings.index')->with('success', 'تم تسجيل الحجز بنجاح يا عبدالله!');
    }

    /**
     * دالة الحذف (إضافية لتكتمل لوحة التحكم عندك)
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'تم حذف الحجز بنجاح');
    }
}