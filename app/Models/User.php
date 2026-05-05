<?php

namespace App\Models;

// استدعاء المكتبات اللازمة
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Booking; // استدعاء موديل الحجوزات للربط

class User extends Authenticatable
{
    /**
     * تفعيل الميزات الإضافية للمستخدم
     * HasApiTokens: للتوثيق عبر API (Sanctum)
     * HasFactory: لإنشاء بيانات وهمية للتجربة
     * Notifiable: لإرسال الإشعارات (مثل الإيميلات)
     */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * الحقول التي يسمح للنظام بتعبئتها تلقائياً
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * الحقول التي يجب إخفاؤها عند تحويل البيانات لـ JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * تحديد نوع البيانات لبعض الحقول
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * ---------------------------------------------------------
     * علاقة المستخدم بالحجوزات (One-to-Many)
     * ---------------------------------------------------------
     * تسمح بجلب حجوزات المستخدم عبر: $user->bookings
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}