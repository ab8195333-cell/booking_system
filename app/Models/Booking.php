<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * الجدول المرتبط بالموديل (اختياري إذا كان الاسم مطابق للمعايير)
     */
    protected $table = 'bookings';

    /**
     * الحقول القابلة للتعبئة (Fillable)
     * ملاحظة: أضفنا حقول الدفع لكي يسمح Laravel بحفظ البيانات فيها
     */
    protected $fillable = [
        'name', 
        'email', 
        'date', 
        'payment_status', 
        'stripe_payment_id', 
        'amount'
    ];

    /**
     * تحويل أنواع البيانات (Casting)
     * يساعد في التعامل مع المبلغ كأرقام عشرية وحالة الدفع
     */
    protected $casts = [
        'date' => 'datetime',
        'amount' => 'decimal:2',
    ];
}