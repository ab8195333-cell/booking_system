@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-header bg-primary text-white p-3" style="border-radius: 20px 20px 0 0;">
                    <h5 class="mb-0 text-center">تعديل بيانات الحجز رقم #{{ $booking->id }}</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">اسم العميل</label>
                            <input type="text" name="customer_name" class="form-control" value="{{ $booking->customer_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">حالة الحجز</label>
                            <select name="status" class="form-select">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>بانتظار الدفع</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>تم الدفع</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success py-2 fw-bold" style="border-radius: 12px;">حفظ التغييرات</button>
                            <a href="{{ route('bookings.index') }}" class="btn btn-light py-2" style="border-radius: 12px;">إلغاء</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection