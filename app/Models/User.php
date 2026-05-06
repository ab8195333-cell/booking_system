<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * الحقول القابلة للتعبئة (Mass Assignment)
     * تأكدنا من إضافة 'role' لكي يتعرف النظام على صلاحياتك
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    /**
     * الحقول التي يجب إخفاؤها عند عرض البيانات
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * تحويل أنواع البيانات (Casting)
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * علاقة المستخدم مع الحجوزات
     * المستخدم الواحد لديه العديد من الحجوزات
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}