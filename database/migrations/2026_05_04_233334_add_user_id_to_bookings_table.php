<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // 1. إضافة عمود user_id إذا لم يكن موجوداً
            if (!Schema::hasColumn('bookings', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id')->nullable();
                
                // إضافة الربط (Foreign Key) لضمان علاقة صحيحة مع جدول المستخدمين
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }

            // 2. حل مشكلة حقل الإيميل: نجعله يقبل قيمة فارغة (Nullable)
            // لتجنب خطأ "Field 'email' doesn't have a default value"
            if (Schema::hasColumn('bookings', 'email')) {
                $table->string('email')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // تراجع عن التعديلات في حال الحاجة
            if (Schema::hasColumn('bookings', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            
            if (Schema::hasColumn('bookings', 'email')) {
                $table->string('email')->nullable(false)->change();
            }
        });
    }
};