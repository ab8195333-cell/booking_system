<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة حجز جديد</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow mx-auto" style="max-width: 500px;">
            <div class="card-header bg-success text-white">إضافة حجز جديد</div>
            <div class="card-body">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">تاريخ الحجز</label>
                        <input type="date" name="booking_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">تأكيد الحجز</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>