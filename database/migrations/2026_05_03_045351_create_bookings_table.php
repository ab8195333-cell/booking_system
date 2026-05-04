<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * تشغيل التهجير (إنشاء الجدول)
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // عمود الاسم (الذي كان يسبب الخطأ)
            $table->string('email');        // عمود البريد الإلكتروني
            $table->date('booking_date');   // عمود تاريخ الحجز
            $table->timestamps();           // أعمدة created_at و updated_at تلقائية
        });
    }

    /**
     * تراجع عن التهجير (حذف الجدول)
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};