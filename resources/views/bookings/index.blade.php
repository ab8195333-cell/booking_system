<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة الحجوزات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
        .table-container { margin-top: 50px; }
        .card-header { font-weight: bold; font-size: 1.2rem; }
    </style>
</head>
<body>

    <div class="container table-container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">نظام إدارة الحجوزات</h2>
            <a href="{{ route('bookings.create') }}" class="btn btn-success">إضافة حجز جديد +</a>
        </div>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                قائمة الحجوزات المسجلة
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>تاريخ الحجز</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $index => $booking)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->email }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                لا توجد بيانات محفوظة حتى الآن. اضغط على "إضافة حجز جديد" للبدء.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-3 text-center text-muted">
            <small>مشروع تخرج - {{ date('Y') }}</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>