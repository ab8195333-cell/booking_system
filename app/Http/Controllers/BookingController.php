<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmed; // تأكد من إنشاء هذا الملف أولاً

class BookingController extends Controller
{
    /**
     * عرض الحجوزات مع كاشف أخطاء
     */
    public function index()
    {
        try {
            $bookings = DB::table('bookings')
                ->where('user_id', Auth::id())
                ->get();

            return view('bookings.index', compact('bookings'));
        } catch (\Exception $e) {
            Log::error("خطأ في العرض: " . $e->getMessage());
            return "❌ كاشف أخطاء [العرض]: " . $e->getMessage();
        }
    }

    public function create()
    {
        return view('bookings.create');
    }

    /**
     * حفظ الحجز وإرسال الإشعار تلقائياً
     */
    public function store(Request $request)
    {
        // التحقق من المدخلات
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required',
        ]);

        try {
            // 1. استخراج بيانات المستخدم الحالي
            $user = Auth::user();

            // 2. حفظ البيانات في قاعدة البيانات
            DB::table('bookings')->insert([
                'name'       => $request->name,
                'date'       => $request->date,
                'user_id'    => $user->id,
                'email'      => $user->email,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. محاولة إرسال الإيميل (نظام كاشف الأخطاء الفرعي)
            try {
                $data = [
                    'name' => $request->name,
                    'date' => $request->date,
                    'email' => $user->email
                ];

                Mail::to($user->email)->send(new BookingConfirmed($data));
                
                $message = 'تم الحجز بنجاح وإرسال إشعار إلى بريدك الإلكتروني! ✅';
            } catch (\Exception $mailError) {
                // إذا فشل الإيميل، نحفظ الحجز وننبه المبرمج في السجلات (Log)
                Log::error("فشل إرسال البريد: " . $mailError->getMessage());
                $message = 'تم الحجز بنجاح، لكن تعذر إرسال الإشعار حالياً. ⚠️';
            }

            return redirect()->route('bookings.index')->with('success', $message);

        } catch (\Exception $e) {
            Log::error("خطأ في الحفظ: " . $e->getMessage());
            return "❌ كاشف أخطاء [الحفظ]: " . $e->getMessage();
        }
    }

    /**
     * حذف الحجز مع كاشف أخطاء
     */
    public function destroy($id)
    {
        try {
            $deleted = DB::table('bookings')
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->delete();

            if ($deleted) {
                return redirect()->route('bookings.index')->with('success', 'تم حذف الحجز بنجاح! 🗑️');
            }

            return redirect()->route('bookings.index')->with('error', 'عذراً، لا تملك الصلاحية.');

        } catch (\Exception $e) {
            Log::error("خطأ في الحذف: " . $e->getMessage());
            return "❌ كاشف أخطاء [الحذف]: " . $e->getMessage();
        }
    }
}