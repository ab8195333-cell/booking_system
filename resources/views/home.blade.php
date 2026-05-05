@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white bg-primary">{{ __('لوحة التحكم') }}</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>أهلاً بك يا {{ Auth::user()->name }}! 👋</h3>
                    <p class="mt-3">أنت الآن مسجل دخولك في نظام إدارة الحجوزات.</p>
                    
                    <hr>

                    <div class="d-grid gap-2 col-6 mx-auto mt-4">
                        <a href="{{ route('bookings.index') }}" class="btn btn-success btn-lg">
                             إدارة الحجوزات 📅
                        </a>
                        <a href="{{ route('bookings.create') }}" class="btn btn-outline-primary">
                            إضافة حجز جديد +
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection