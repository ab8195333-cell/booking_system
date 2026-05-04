<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>تسجيل الدخول - نظام الحجوزات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f6; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 400px; }
        .btn-success { border-radius: 50px; }
    </style>
</head>
<body>
    <div class="card p-4">
        <h3 class="text-center mb-4 fw-bold text-success">تسجيل الدخول</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100 py-2">دخول</button>
        </form>
        <div class="text-center mt-3">
            <a href="/register" class="text-decoration-none small text-muted">ليس لديك حساب؟ سجل من هنا</a>
        </div>
    </div>
</body>
</html>