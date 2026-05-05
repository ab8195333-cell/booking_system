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
            // إضافة أعمدة الدفع لجدول الحجوزات
            $table->string('payment_status')->default('pending')->after('email'); 
            $table->string('stripe_payment_id')->nullable()->after('payment_status');
            $table->decimal('amount', 8, 2)->default(100.00)->after('stripe_payment_id'); // افترضنا السعر 100 كمثال
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // حذف الأعمدة في حال تراجعنا عن Migration
            $table->dropColumn(['payment_status', 'stripe_payment_id', 'amount']);
        });
    }
};