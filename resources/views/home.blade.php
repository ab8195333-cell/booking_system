@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 pt-4 text-center">
                    <h3 class="fw-bold">مرحباً بك، {{ Auth::user()->name }} 👋</h3>
                </div>

                <div class="card-body text-center pb-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text-muted mb-4">لقد سجلت دخولك بنجاح. يمكنك الآن إدارة حجوزاتك أو الاطلاع على حالتها.</p>
                    
                    <div class="d-grid gap-2 col-8 mx-auto">
                        {{-- الزر الذي تم إصلاحه ليتناسب مع خريطة الروابط --}}
                        <a href="{{ route('bookings.index') }}" class="btn btn-primary btn-lg shadow-sm" style="border-radius: 10px; padding: 15px;">
                            <i class="bi bi-calendar-check me-2"></i>
                            دخول لقسم الحجوزات
                        </a>
                        
                        <a href="/" class="btn btn-outline-secondary btn-sm mt-3 border-0">
                            العودة للرئيسية
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f0f2f5;
    }
    .btn-primary {
        background-color: #4a90e2;
        border: none;
    }
    .btn-primary:hover {
        background-color: #357abd;
        transform: translateY(-2px);
        transition: 0.3s;
    }
</style>
@endsection