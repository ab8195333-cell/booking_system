<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * الحقول التي يمكن تعبئتها وحفظها في قاعدة البيانات.
     * تأكد أن أسماء هذه الحقول تطابق تماماً أسماء الأعمدة في جدول bookings.
     */
    protected $fillable = [
        'customer_name', 
        'amount', 
        'status', 
        'user_id'
    ];

    /**
     * علاقة الحجز بالمستخدم: كل حجز يتبع لمستخدم واحد.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}