@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-header bg-primary text-white text-center py-3" style="border-radius: 20px 20px 0 0;">
                    <h4 class="mb-0 fw-bold">إضافة حجز جديد</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf

                        {{-- اسم العميل --}}
                        <div class="mb-4">
                            <label for="customer_name" class="form-label fw-bold">اسم العميل</label>
                            <input type="text" name="customer_name" id="customer_name" 
                                   class="form-control @error('customer_name') is-invalid @enderror" 
                                   placeholder="أدخل اسم العميل بالكامل" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- المبلغ الثابت (الجزء الذي طلبته) --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted">المبلغ المطلوب (ثابت لهذا الحجز)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-primary fw-bold">$</span>
                                <input type="text" class="form-control bg-light fw-bold" value="50.00" readonly disabled>
                            </div>
                            <small class="text-muted">ملاحظة: الرسوم ثابتة ولا يمكن تعديلها.</small>
                            
                            {{-- إرسال القيمة مخفية لكي تصل للمتحكم --}}
                            <input type="hidden" name="amount" value="50.00">
                        </div>

                        <hr class="my-4 opacity-25">

                        {{-- أزرار التحكم --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm" style="border-radius: 12px;">
                                <i class="bi bi-check-circle me-2"></i> حفظ الحجز والذهاب للدفع
                            </button>
                            <a href="{{ route('bookings.index') }}" class="btn btn-light" style="border-radius: 12px;">
                                إلغاء والعودة
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8fafc;
    }
    .form-control {
        border-radius: 10px;
        padding: 12px;
        border: 1px solid #e2e8f0;
    }
    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }
    .input-group-text {
        border-radius: 10px 0 0 10px !important;
    }
    input[readonly] {
        cursor: not-allowed;
    }
</style>
@endsection