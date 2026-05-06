<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * تشغيل التهجير لبناء الجدول
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // اسم العميل
            $table->string('customer_name'); 
            
            // المبلغ مع جعل 50.00 قيمة افتراضية كما طلبت
            $table->decimal('amount', 8, 2)->default(50.00); 
            
            // حالة الحجز الافتراضية
            $table->string('status')->default('pending');
            
            // ربط الحجز بالمستخدم
            $table->unsignedBigInteger('user_id');
            
            $table->timestamps();

            // إضافة العلاقة مع جدول المستخدمين
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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