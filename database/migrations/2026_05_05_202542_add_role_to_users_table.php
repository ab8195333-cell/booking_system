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
        Schema::table('users', function (Blueprint $table) {
            /**
             * إضافة عمود الصلاحيات:
             * admin: مدير النظام
             * registrar: المسجل
             * user: زائر/مستخدم مسجل عادي
             */
            $table->string('role')->default('user')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // حذف العمود عند عمل rollback
            $table->dropColumn('role');
        });
    }
};