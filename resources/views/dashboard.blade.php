<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('لوحة التحكم - نظام الحجوزات الاحترافي') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 bg-white p-6 rounded-lg shadow-sm border">
                <h4 class="font-bold mb-4 text-gray-700">إضافة حجز جديد للنظام</h4>
                <form action="{{ route('bookings.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-5">
                        <label class="form-label text-sm text-gray-600">نوع الخدمة</label>
                        <input type="text" name="service_name" placeholder="مثلاً: حجز فندق" class="form-control rounded-pill" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-sm text-gray-600">موعد الحجز</label>
                        <input type="datetime-local" name="booking_date" class="form-control rounded-pill" required>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100 rounded-pill font-bold shadow-sm">
                            حفظ الحجز الآن
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border">
                <h3 class="text-lg font-bold mb-4 text-gray-800 border-bottom pb-2">قائمة حجوزاتي الحالية</h3>
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-right">الإجراء / الخدمة</th>
                            <th class="text-center">التاريخ والوقت</th>
                            <th class="text-center">الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $userBookings = \App\Models\Booking::where('user_id', auth()->id())->latest()->get();
                        @endphp

                        @forelse($userBookings as $booking)
                            <tr>
                                <td style="width: 40%;">
                                    <button class="btn btn-primary w-100 rounded-pill text-white font-bold shadow-sm">
                                        {{ $booking->service_name }}
                                    </button>
                                </td>

                                <td class="text-center text-gray-700 font-medium">
                                    {{ $booking->booking_date }}
                                </td>

                                <td class="text-center">
                                    @if($booking->status == 'pending')
                                        <span class="badge rounded-pill bg-warning text-dark px-4 py-2">
                                            قيد الانتظار
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-success px-4 py-2">
                                            تم التأكيد
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500 italic">
                                    لا توجد حجوزات مسجلة حالياً.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>