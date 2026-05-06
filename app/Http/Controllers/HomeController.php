<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // هذا السطر يمنع أي شخص غير مسجل دخول من دخول هذه الصفحة
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 1. إذا كان المستخدم مدير (admin)
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 2. إذا كان مستخدم عادي (user) يفتح له صفحة الـ home
        return view('home');
    }
}