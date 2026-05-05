@extends('layouts.app')

@section('content')
<div class="container mt-5 text-right" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white"><h4>إضافة حجز</h4></div>
                <div class="card-body">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>الاسم</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>البريد</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>التاريخ</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">موافق</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection