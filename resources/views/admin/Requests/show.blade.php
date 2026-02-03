@extends('admin.index')
@section('admin')

@php
    $event = \App\Models\Event::where('request_id', $request->id)->first();
    $statusColors = [
        'لم يتم البدء فى الاجراءات' => 'danger',
        'الاتصال بالعميل' => 'info',
        'جاري توفير عروض له' => 'success',
        'تم ارسال العروض له' => 'warning',
        'تحديد موعد لمشاهده العروض' => 'primary',
        'دفع عربون وحجز العرض' => 'secondary',
        'اغلاق طلب العميل' => 'dark'
    ];
    $statusColor = $statusColors[$request->traking_client] ?? 'secondary';
@endphp

<div class="col-12">
    <!-- Page Header with Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('requests.index') }}" class="btn btn-light ml-3">
                <i class="fas fa-arrow-right"></i>
            </a>
            <div>
                <h4 class="mb-1">تفاصيل الطلب</h4>
                <p class="text-muted mb-0">معلومات العميل والمتابعة</p>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-primary">
                <i class="fas fa-edit ml-1"></i> تعديل
            </a>
            <form action="{{ route('requests.destroy', $request->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطلب؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash ml-1"></i> حذف
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- Client Information Card -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header border-0" style="background: linear-gradient(135deg, #0F302E 0%, #1a4a47 100%); color: white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">
                                <i class="fas fa-user-circle ml-2"></i>
                                {{ $request->client_name }}
                            </h4>
                            <small class="text-white-50">{{ $request->client_type }}</small>
                        </div>
                        <div class="text-left">
                            @if($statusColor == 'danger')
                                <span class="badge badge-danger" style="font-size: 0.9rem; padding: 8px 15px;">
                                    {{ $request->traking_client ?? 'جديد' }}
                                </span>
                            @elseif($statusColor == 'success')
                                <span class="badge badge-success" style="font-size: 0.9rem; padding: 8px 15px;">
                                    {{ $request->traking_client }}
                                </span>
                            @elseif($statusColor == 'info')
                                <span class="badge badge-info" style="font-size: 0.9rem; padding: 8px 15px;">
                                    {{ $request->traking_client }}
                                </span>
                            @elseif($statusColor == 'warning')
                                <span class="badge badge-warning" style="font-size: 0.9rem; padding: 8px 15px;">
                                    {{ $request->traking_client }}
                                </span>
                            @elseif($statusColor == 'primary')
                                <span class="badge badge-primary" style="font-size: 0.9rem; padding: 8px 15px;">
                                    {{ $request->traking_client }}
                                </span>
                            @elseif($statusColor == 'dark')
                                <span class="badge badge-dark" style="font-size: 0.9rem; padding: 8px 15px;">
                                    {{ $request->traking_client }}
                                </span>
                            @else
                                <span class="badge badge-secondary" style="font-size: 0.9rem; padding: 8px 15px;">
                                    {{ $request->traking_client ?? 'جديد' }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="info-item mb-3">
                                <label class="text-muted mb-1">
                                    <i class="fas fa-phone text-primary ml-2"></i>
                                    رقم الهاتف
                                </label>
                                <h6 class="mb-0">
                                    <a href="tel:{{ $request->client_phone }}" class="text-dark" style="direction: ltr; display: block;">
                                        {{ $request->client_phone }}
                                    </a>
                                </h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item mb-3">
                                <label class="text-muted mb-1">
                                    <i class="fas fa-user-tag text-info ml-2"></i>
                                    نوع العميل
                                </label>
                                <h6 class="mb-0">{{ $request->client_type }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item mb-3">
                                <label class="text-muted mb-1">
                                    <i class="fas fa-map-marker-alt text-danger ml-2"></i>
                                    المدينة
                                </label>
                                <h6 class="mb-0">{{ $request->city ?? 'غير محدد' }}</h6>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="info-item mb-3">
                                <label class="text-muted mb-1">
                                    <i class="fas fa-clipboard-list text-success ml-2"></i>
                                    نوع الطلب
                                </label>
                                <h6 class="mb-0">{{ $request->request_name }}</h6>
                            </div>
                        </div>
                    </div>

                    @if($request->other_request)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-item">
                                <label class="text-muted mb-1">
                                    <i class="fas fa-file-alt text-warning ml-2"></i>
                                    ملاحظات إضافية
                                </label>
                                <p class="mb-0 p-3" style="background: #f8f9fa; border-radius: 8px; border-right: 4px solid #0F302E;">
                                    {{ $request->other_request }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Tracking Timeline Card -->
            <div class="card">
                <div class="card-header border-0">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tasks ml-2 text-primary"></i>
                        حالة المتابعة
                    </h5>
                </div>
                <div class="card-body">
                    <div class="tracking-status p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 10px;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted mb-2">الحالة الحالية</h6>
                                <h4 class="mb-0 font-weight-bold" style="color: #0F302E;">
                                    {{ $request->traking_client ?? 'لم يتم البدء في الإجراءات' }}
                                </h4>
                            </div>
                            <div class="text-center">
                                <div class="status-icon" style="width: 80px; height: 80px; border-radius: 50%; background: white; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                    @if($statusColor == 'success')
                                        <i class="fas fa-check-circle" style="font-size: 40px; color: #28a745;"></i>
                                    @elseif($statusColor == 'danger')
                                        <i class="fas fa-exclamation-circle" style="font-size: 40px; color: #dc3545;"></i>
                                    @elseif($statusColor == 'warning')
                                        <i class="fas fa-paper-plane" style="font-size: 40px; color: #ffc107;"></i>
                                    @elseif($statusColor == 'info')
                                        <i class="fas fa-phone-alt" style="font-size: 40px; color: #17a2b8;"></i>
                                    @else
                                        <i class="fas fa-hourglass-half" style="font-size: 40px; color: #6c757d;"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Card -->
        <div class="col-lg-4">
            <div class="card mb-4" style="border-top: 4px solid #0F302E;">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-calendar-alt" style="font-size: 48px; color: #0F302E;"></i>
                    </div>
                    <h5 class="mb-3">موعد المقابلة</h5>
                    @if($event && isset($event->start))
                        <div class="appointment-details p-3" style="background: #f8f9fa; border-radius: 10px;">
                            <div class="mb-2">
                                <i class="fas fa-calendar text-primary ml-2"></i>
                                <strong>التاريخ:</strong>
                                <br>
                                <span class="text-muted">
                                    {{ \Carbon\Carbon::parse($event->start)->locale('ar')->isoFormat('dddd، DD MMMM YYYY') }}
                                </span>
                            </div>
                            <div>
                                <i class="fas fa-clock text-success ml-2"></i>
                                <strong>الوقت:</strong>
                                <br>
                                <span class="text-muted">
                                    {{ \Carbon\Carbon::parse($event->start)->locale('ar')->isoFormat('h:mm a') }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-info-circle ml-2"></i>
                            لم يتم تحديد موعد بعد
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card">
                <div class="card-header border-0">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt ml-2 text-warning"></i>
                        إجراءات سريعة
                    </h5>
                </div>
                <div class="card-body">
                    <a href="tel:{{ $request->client_phone }}" class="btn btn-success btn-block mb-2">
                        <i class="fas fa-phone ml-2"></i>
                        اتصال بالعميل
                    </a>
                    <a href="https://wa.me/{{ str_replace([' ', '-', '+'], '', $request->client_phone) }}" target="_blank" class="btn btn-success btn-block mb-2" style="background: #25d366; border-color: #25d366;">
                        <i class="fab fa-whatsapp ml-2"></i>
                        واتساب
                    </a>
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#setAppointmentModal">
                        <i class="fas fa-calendar-plus ml-2"></i>
                        تحديد موعد
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Set Appointment Modal -->
<div class="modal fade" id="setAppointmentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #0F302E; color: white;">
                <h5 class="modal-title">
                    <i class="fas fa-calendar-plus ml-2"></i>
                    تحديد موعد المقابلة
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('requests.applyTime') }}" method="POST">
                @csrf
                <input type="hidden" name="selectedIds" value="{{ $request->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="contact_datetime">التاريخ والوقت</label>
                        <input type="datetime-local" name="contact_datetime" id="contact_datetime" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary" style="background: #0F302E; border-color: #0F302E;">
                        <i class="fas fa-check ml-1"></i>
                        حفظ الموعد
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .info-item label {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-item h6 {
        font-size: 1.1rem;
        color: #2c3e50;
    }

    .card {
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        border: none;
        border-radius: 12px;
    }

    .card-header {
        border-radius: 12px 12px 0 0 !important;
    }

    .btn {
        border-radius: 8px;
        font-weight: 600;
    }

    .status-icon {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }
</style>
@endpush