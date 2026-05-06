<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مرحباً بك في نظام الحجوزات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .welcome-card {
            text-align: center;
            max-width: 600px;
            padding: 40px;
        }
        .welcome-icon {
            font-size: 80px;
            color: #6c757d;
            margin-bottom: 20px;
        }
        .btn-dashboard {
            background-color: #5a8dee;
            border: none;
            padding: 12px 40px;
            border-radius: 10px;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }
        .btn-dashboard:hover {
            background-color: #4877d1;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(90, 141, 238, 0.3);
        }
    </style>
</head>
<body>

    <div class="welcome-card">
        <div class="welcome-icon">
            <i class="bi bi-calendar3"></i>
        </div>

        <h1 class="fw-bold mb-3">مرحباً بك في نظام الحجوزات</h1>
        <p class="text-muted fs-5 mb-5">
            نظام ذكي لإدارة حجوزاتك بكل سهولة واحترافية.
        </p>

        {{-- التعديل الجوهري هنا: تغيير route(admin.dashboard) إلى route(bookings.index) --}}
        <div class="d-grid gap-2 col-10 mx-auto">
            @auth
                <a href="{{ route('bookings.index') }}" class="btn btn-primary btn-dashboard shadow">
                    لوحة التحكم (Dashboard)
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-dashboard shadow">
                    تسجيل الدخول للمتابعة
                </a>
            @endauth
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>