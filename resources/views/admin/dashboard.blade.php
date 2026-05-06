@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="d-flex justify-content-between align-items-center bg-white p-3 shadow-sm rounded">
                <h2 class="mb-0">لوحة تحكم المدير</h2>
                <span class="badge bg-danger p-2">نظام الإدارة</span>
            </div>
            <hr>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card bg-gradient-primary text-white shadow border-0" style="background: linear-gradient(45deg, #4e73df, #224abe);">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="text-uppercase mb-1" style="font-size: 0.9rem;">إجمالي الحجوزات</h5>
                            <h2 class="display-4 font-weight-bold mb-0">{{ $totalBookings }}</h2>
                        </div>
                        <i class="fas fa-calendar-check fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card bg-gradient-success text-white shadow border-0" style="background: linear-gradient(45deg, #1cc88a, #13855c);">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="text-uppercase mb-1" style="font-size: 0.9rem;">المستخدمين المسجلين</h5>
                            <h2 class="display-4 font-weight-bold mb-0">{{ $totalUsers }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">آخر 5 حجوزات في النظام</h5>
            <i class="fas fa-history"></i>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th>اسم العميل</th>
                            <th>المبلغ الإجمالي</th>
                            <th>حالة الحجز</th>
                            <th>تاريخ الإضافة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestBookings as $booking)
                        <tr>
                            <td class="align-middle font-weight-bold text-dark">{{ $booking->customer_name }}</td>
                            <td class="align-middle text-primary">{{ number_format($booking->amount, 2) }}$</td>
                            <td class="align-middle">
                                @if($booking->status == 'paid')
                                    <span class="badge bg-success">تم الدفع</span>
                                @else
                                    <span class="badge bg-warning text-dark">بانتظar الدفع</span>
                                @endif
                            </td>
                            <td class="align-middle text-muted">{{ $booking->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-4 text-muted">لا توجد حجوزات مسجلة حتى الآن.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white text-end">
            <a href="{{ route('bookings.index') }}" class="btn btn-outline-dark btn-sm">
                عرض كافة الحجوزات والتحكم بها ←
            </a>
        </div>
    </div>
</div>

<style>
    /* تحسينات بسيطة للتصميم ليدعم العربية بشكل أفضل */
    body {
        background-color: #f8f9fc;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
        border-radius: 10px;
    }
    .table thead th {
        border-top: none;
    }
</style>
@endsection