@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 mt-5" style="border-radius: 25px;">
                <div class="bg-primary p-4 text-center text-white" style="border-radius: 25px 25px 0 0;">
                    <h3 class="fw-bold mb-0">الدفع الآمن بالبطاقة</h3>
                    <small class="opacity-75">نحن نشفر بياناتك لضمان أمانك</small>
                </div>

                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h1 class="display-5 fw-bold text-primary">{{ number_format($booking->amount, 2) }} $</h1>
                        <p class="text-muted small">الدفع للحجز رقم #{{ $booking->id }}</p>
                    </div>

                    <form action="{{ route('stripe.post') }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                        {{-- حقول البطاقة --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">اسم صاحب البطاقة</label>
                            <input type="text" class="form-control" placeholder="Abdullah Maher" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">بيانات البطاقة البنكية</label>
                            <div id="card-element" class="form-control" style="padding: 12px;">
                                {{-- هنا يظهر حقل Stripe الذكي --}}
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm" style="background-color: #6772e5; border: none; border-radius: 12px;">
                                <i class="bi bi-credit-card-2-front me-2"></i> تأكيد الدفع الآن
                            </button>
                            <a href="{{ route('bookings.index') }}" class="btn btn-link text-muted">إلغاء</a>
                        </div>
                    </form>
                </div>

                <div class="card-footer bg-transparent border-0 text-center pb-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg" width="80" class="opacity-50">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- استدعاء مكتبة Stripe --}}
<script src="https://js.stripe.com/v3/"></script>
<script>
    // تهيئة Stripe باستخدام مفتاح الاختبار (Test Key)
    var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx'); // هذا مفتاح تجريبي عالمي
    var elements = stripe.elements();

    var style = {
        base: {
            fontSize: '16px',
            color: '#32325d',
        }
    };

    var card = elements.create('card', {style: style});
    card.mount('#card-element');
</script>
@endsection