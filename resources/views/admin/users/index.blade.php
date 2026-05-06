@extends('layouts.app')

@section('content')
<div class="container" dir="rtl" style="text-align: right;">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">إدارة مستخدمي النظام</h2>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">العودة للوحة التحكم</a>
            </div>
            <hr>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white">
            قائمة المستخدمين المسجلين
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الرتبة الحالية</th>
                            <th>تغيير الرتبة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">
                                @if($user->role == 'admin')
                                    <span class="badge bg-danger text-white">مدير (Admin)</span>
                                @elseif($user->role == 'registrar')
                                    <span class="badge bg-info text-dark">مسجل (Registrar)</span>
                                @else
                                    <span class="badge bg-secondary text-white">مستخدم (User)</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <form action="{{ route('users.updateRole', $user->id) }}" method="POST" class="d-flex justify-content-center align-items-center">
                                    @csrf 
                                    @method('PATCH')
                                    <select name="role" class="form-select form-select-sm w-auto" style="min-width: 120px;">
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="registrar" {{ $user->role == 'registrar' ? 'selected' : '' }}>Registrar</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary mr-2">تحديث</button>
                                </form>
                            </td>
                            <td class="align-middle">
                                @if($user->id !== auth()->id()) {{-- لا يمكن للمدير حذف نفسه --}}
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم نهائياً؟');">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                                @else
                                    <span class="text-muted small">حسابك الحالي</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* تنسيقات إضافية لتحسين المظهر */
    .table th, .table td {
        vertical-align: middle !important;
    }
    .badge {
        font-size: 0.85rem;
        padding: 0.5em 0.7em;
    }
    .form-select-sm {
        height: calc(1.5em + 0.5rem + 2px);
    }
    .mr-2 {
        margin-right: 0.5rem;
    }
</style>
@endsection