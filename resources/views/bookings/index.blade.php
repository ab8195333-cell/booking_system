@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    
    {{-- عرض رسائل النجاح --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            {{-- فحص الصلاحيات باستخدام الإيميل المعتمد ab8195333@gmail.com --}}
            @if(Auth::user()->role == 'admin' || Auth::user()->email == 'ab8195333@gmail.com')
                <i class="bi bi-shield-lock-fill text-danger me-2"></i> لوحة تحكم الإدارة
            @else
                <i class="bi bi-calendar-check-fill text-primary me-2"></i> حجوزاتي الشخصية
            @endif
        </h2>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg"></i> إضافة حجز جديد
        </a>
    </div>

    {{-- --- بداية قسم الإدارة (الجدول) --- --}}
    @if(Auth::user()->role == 'admin' || Auth::user()->email == 'ab8195333@gmail.com')
        <div class="card shadow-sm border-0" style="border-radius: 15px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="p-3">رقم الحجز</th>
                                <th class="p-3">اسم العميل</th>
                                <th class="p-3">المبلغ</th>
                                <th class="p-3">الحالة</th>
                                <th class="p-3">تاريخ الحجز</th>
                                <th class="p-3 text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td class="p-3 fw-bold">#{{ $booking->id }}</td>
                                    <td class="p-3">{{ $booking->customer_name }}</td>
                                    <td class="p-3 text-success fw-bold">${{ number_format($booking->amount, 2) }}</td>
                                    <td class="p-3">
                                        @if($booking->status == 'completed')
                                            <span class="badge bg-success-soft text-success p-2" style="background-color: #e8f5e9;">تم الدفع</span>
                                        @else
                                            <span class="badge bg-warning-soft text-warning p-2" style="background-color: #fff3e0;">بانتظار الدفع</span>
                                        @endif
                                    </td>
                                    <td class="p-3 text-muted">{{ $booking->created_at->format('Y-m-d') }}</td>
                                    <td class="p-3 text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil"></i> تعديل
                                            </a>
                                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الحجز؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm ms-1">
                                                    <i class="bi bi-trash"></i> حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5 text-muted">لا يوجد حجوزات مسجلة في النظام حالياً.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    {{-- --- بداية قسم المستخدم العادي (البطاقات) --- --}}
    @else
        <div class="row">
            @forelse($bookings as $booking)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="border-radius: 15px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title fw-bold">حجز #{{ $booking->id }}</h5>
                                <span class="badge {{ $booking->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $booking->status == 'completed' ? 'تم الدفع' : 'بانتظار الدفع' }}
                                </span>
                            </div>
                            <p class="card-text text-muted">العميل: {{ $booking->customer_name }}</p>
                            <h4 class="text-primary fw-bold mb-3">${{ number_format($booking->amount, 2) }}</h4>
                            
                            @if($booking->status != 'completed')
                                <a href="{{ route('stripe.payment', $booking->id) }}" class="btn btn-success w-100 py-2">
                                    <i class="bi bi-credit-card me-2"></i> اِدفع الآن عبر Stripe
                                </a>
                            @else
                                <button class="btn btn-secondary w-100 py-2" disabled>
                                    <i class="bi bi-check-circle me-2"></i> تم تأكيد الدفع
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center p-5">
                    <div class="mb-3"><i class="bi bi-calendar-x" style="font-size: 3rem; color: #ccc;"></i></div>
                    <p class="text-muted">ليس لديك أي حجوزات حالياً.</p>
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary">أنشئ أول حجز لك الآن</a>
                </div>
            @endforelse
        </div>
    @endif

</div>

{{-- أضفنا أيقونات Bootstrap لتجميل الواجهة --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endsection