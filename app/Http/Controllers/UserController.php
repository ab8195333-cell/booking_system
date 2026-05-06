<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * عرض قائمة كافة المستخدمين للمدير فقط
     */
    public function index()
    {
        // التأكد أن المستخدم الحالي هو مدير
        if (auth()->user()->role !== 'admin') {
            abort(403, 'عذراً، هذه الصفحة مخصصة للمديرين فقط.');
        }

        // جلب جميع المستخدمين من قاعدة البيانات
        $users = User::all();

        // عرض الصفحة الموجودة في resources/views/admin/users/index.blade.php
        return view('admin.users.index', compact('users'));
    }

    /**
     * تحديث رتبة المستخدم (admin, user, registrar)
     */
    public function updateRole(Request $request, User $user)
    {
        // التحقق من صحة البيانات القادمة
        $request->validate([
            'role' => 'required|in:admin,user,registrar',
        ]);

        // تحديث الرتبة في قاعدة البيانات
        $user->update([
            'role' => $request->role
        ]);

        return back()->with('success', 'تم تحديث رتبة المستخدم ' . $user->name . ' بنجاح.');
    }

    /**
     * حذف مستخدم نهائياً من النظام
     */
    public function destroy(User $user)
    {
        // منع المدير من حذف نفسه بالخطأ
        if ($user->id === auth()->id()) {
            return back()->with('error', 'لا يمكنك حذف حسابك الشخصي أثناء تسجيل الدخول.');
        }

        $user->delete();

        return back()->with('success', 'تم حذف المستخدم بنجاح.');
    }
}