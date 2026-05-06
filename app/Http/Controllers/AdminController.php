<?php

namespace App\Http\Controllers; // تأكد أن هذا السطر مكتوب بدقة

use Illuminate\Http\Request;
use App\Models\Booking; // لاستيراد موديل الحجوزات
use App\Models\User;    // لاستيراد موديل المستخدمين

class AdminController extends Controller
{
    /**
     * عرض لوحة تحكم المدير
     */
    public function index()
    {
        // جلب البيانات من قاعدة البيانات لعرضها في الإحصائيات
        $totalBookings = Booking::count();
        $totalUsers = User::count();
        $latestBookings = Booking::latest()->take(5)->get();

        // إرسال البيانات إلى ملف الـ View (admin/dashboard)
        return view('admin.dashboard', compact('totalBookings', 'totalUsers', 'latestBookings'));
    }
}