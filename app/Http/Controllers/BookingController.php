<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingNotification; // التأكد من استدعاء ملف الإشعارات
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
    /**
     * تأمين الوصول للمستخدمين المسجلين فقط
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * عرض قائمة الحجوزات (وضع الإدارة للمدير ووضع المستخدم للعميل)
     */
    public function index()
    {
        // التحقق عبر البريد الإلكتروني الصحيح أو الرتبة
        if (Auth::user()->email == 'ab8195333@gmail.com' || Auth::user()->role == 'admin') {
            // المدير يرى كل الحجوزات
            $bookings = Booking::all(); 
        } else {
            // المستخدم يرى حجوزاته فقط
            $bookings = Booking::where('user_id', Auth::id())->get();
        }

        return view('bookings.index', compact('bookings'));
    }

    /**
     * عرض صفحة إضافة حجز جديد
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * حفظ الحجز وإرسال إشعارات البريد الإلكتروني (للعميل وللإدارة)
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
        ]);

        // 1. إنشاء الحجز في قاعدة البيانات
        $booking = Booking::create([
            'customer_name' => $request->customer_name,
            'amount' => 50.00,
            'status' => 'pending',
            'user_id' => Auth::id(),
        ]);

        try {
            // 2. إرسال إشعار للمستخدم (تأكيد الحجز)
            Auth::user()->notify(new BookingNotification($booking, 'user'));

            // 3. إرسال إشعار للأدمن عبر البريد الصحيح
            $admin = User::where('email', 'a8195333@gmail.com')->first();
            if ($admin) {
                $admin->notify(new BookingNotification($booking, 'admin'));
            }
        } catch (\Exception $e) {
            // في حال وجود مشكلة في الاتصال بخادم البريد، يتم الحجز مع تنبيه بسيط
            return redirect()->route('bookings.index')->with('success', 'تم الحجز بنجاح (ملاحظة: تعذر إرسال الإشعار البريدي حالياً)');
        }

        return redirect()->route('bookings.index')->with('success', 'تم الحجز بنجاح! تم إرسال إشعار تأكيد لك وللإدارة ✅');
    }

    /**
     * عرض صفحة التعديل (خاص بالأدمن)
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.edit', compact('booking'));
    }

    /**
     * تحديث بيانات الحجز
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'تم تحديث بيانات الحجز بنجاح');
    }

    /**
     * حذف الحجز (خاص بالأدمن)
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'تم حذف الحجز بنجاح');
    }
}