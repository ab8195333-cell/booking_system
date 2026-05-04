<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. حل مشكلة طول المفاتيح في بعض قواعد البيانات (اختياري لكنه مفيد)
        Schema::defaultStringLength(191);

        // 2. إذا كنت تريد توجيه المستخدم بعد تسجيل الدخول من هنا 
        // (في حال لم تجد ملف RouteServiceProvider)
    }
}