<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. التحقق من أن المستخدم سجل دخوله
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. التحقق من أن دور المستخدم موجود ضمن الأدوار المسموح بها
        // استخدمنا in_array لدعم تمرير أكثر من دور مثل role:admin,registrar
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // 3. إذا لم يملك الصلاحية، يتم توجيهه للرئيسية مع رسالة خطأ
        return redirect('/home')->with('error', 'عذراً، لا تملك صلاحية الوصول لهذه الصفحة.');
    }
}