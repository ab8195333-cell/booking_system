<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * تنفيذ عملية إنشاء الجدول في قاعدة البيانات
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');      // اسم العميل
            $table->string('email');     // بريد العميل
            $table->date('date');        // تاريخ الحجز
            $table->timestamps();        // توقيت الإنشاء والتحديث تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * التراجع عن العملية وحذف الجدول
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};