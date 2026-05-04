<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * الحقول المسموح بتعبئتها (لحماية البيانات)
     * تأكد من كتابتها بنفس الحروف الموجودة في قاعدة البيانات
     */
    protected $fillable = [
        'name', 
        'email', 
        'booking_date'
    ];
}