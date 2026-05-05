<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - نظام حجز عبدالله</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-brand { font-weight: bold; color: #333; }
        .table shadow { background: white; border-radius: 10px; overflow: hidden; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">نظام حجز عبدالله</a>
        <div class="d-flex align-items-center">
            @auth
                <span class="me-3 text-muted">مرحباً، {{ auth()->user()->name }}</span>
                <a class="btn btn-outline-danger btn-sm" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    تسجيل الخروج
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
        </div>
    </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">قائمة الحجوزات</h2>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary">إضافة حجز جديد +</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">اسم العميل</th>
                        <th>البريد الإلكتروني</th>
                        <th>المبلغ</th>
                        <th>الحالة</th>
                        <th class="text-center">الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $item)
                    <tr class="align-middle">
                        <td class="ps-4">{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->amount }}$</td>
                        <td>
                            @if($item->payment_status == 'paid')
                                <span class="badge bg-success-subtle text-success border border-success-subtle">تم الدفع</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">بانتظار الدفع</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->payment_status != 'paid')
                                <a href="{{ route('payment.checkout', $item->id) }}" 
                                   class="btn btn-sm px-3" 
                                   style="background-color: #6772e5; color: white;">
                                   ادفع الآن Stripe
                                </a>
                            @else
                                <span class="text-success fw-bold small">مكتمل ✅</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">لا توجد حجوزات حالياً.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>