<x-guest-layout>
    <div class="text-center mb-4">
        <div class="mb-3">
            <i class="fas fa-user-plus fa-3x text-success"></i>
        </div>
        <h3 class="fw-bold text-success">إنشاء حساب جديد</h3>
        <p class="text-muted small">انضم إلينا وابدأ بتنظيم حجوزاتك</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label text-secondary small fw-bold">الاسم الكامل</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-success text-success"><i class="fas fa-user"></i></span>
                <input type="text" name="name" class="form-control border-success shadow-none" placeholder="أدخل اسمك الكامل" value="{{ old('name') }}" required autofocus>
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label class="form-label text-secondary small fw-bold">البريد الإلكتروني</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-success text-success"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" class="form-control border-success shadow-none" placeholder="name@example.com" value="{{ old('email') }}" required>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label class="form-label text-secondary small fw-bold">كلمة المرور</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-success text-success"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" class="form-control border-success shadow-none" required autocomplete="new-password">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label class="form-label text-secondary small fw-bold">تأكيد كلمة المرور</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-success text-success"><i class="fas fa-check-double"></i></span>
                <input type="password" name="password_confirmation" class="form-control border-success shadow-none" required>
            </div>
        </div>

        <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-success fw-bold py-2 shadow-sm rounded-pill">
                إنشاء الحساب الآن <i class="fas fa-arrow-left ms-2"></i>
            </button>
        </div>

        <div class="text-center mt-4 border-top pt-3">
            <p class="small text-muted mb-2">لديك حساب بالفعل؟</p>
            <a href="{{ url('/login') }}" class="btn btn-outline-success btn-sm rounded-pill px-4 fw-bold shadow-none">
                سجل دخول من هنا
            </a>
        </div>
    </form>
</x-guest-layout>