@extends('admin.index')
@section('admin')

<div class="col-12">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">قائمة الطلبات</h4>
            <p class="text-muted mb-0">إدارة طلبات العملاء والمتابعة</p>
        </div>
        <a href="{{ route('requests.create') }}" class="btn btn-primary">
            <i class="fas fa-plus ml-2"></i> إضافة طلب جديد
        </a>
    </div>

    <!-- Quick Actions Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="{{ route('requests.applyAction') }}" class="d-flex align-items-center gap-2" id="clientForm" onclick="applyAction()">
                        @csrf
                        <input type="hidden" name="selectedIds" id="selectedIds" value="">
                        <label class="mb-0 ml-2 font-weight-bold">تغيير الحالة:</label>
                        <select name="traking_client" class="form-control select2" style="width: 250px;">
                            <option value="">اختر الإجراء</option>
                            @php
                                $statusOptions = [
                                    'لم يتم البدء فى الاجراءات' => 'danger',
                                    'الاتصال بالعميل' => 'info',
                                    'جاري توفير عروض له' => 'success',
                                    'تم ارسال العروض له' => 'warning',
                                    'تحديد موعد لمشاهده العروض' => 'primary',
                                    'دفع عربون وحجز العرض' => 'secondary',
                                    'اغلاق طلب العميل' => 'dark'
                                ];
                            @endphp
                            @foreach($statusOptions as $option => $color)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-check ml-1"></i> تطبيق
                        </button>
                    </form>
                </div>
                <div class="col-md-6">
                    <form method="post" action="{{ route('requests.applyTime') }}" class="d-flex align-items-center gap-2 justify-content-end" id="clientFormTime" onclick="applyTime()">
                        @csrf
                        <input type="hidden" name="selectedIds" id="selectedIdsTime" value="">
                        <label class="mb-0 ml-2 font-weight-bold">تحديد موعد:</label>
                        <input type="datetime-local" name="contact_datetime" class="form-control" style="width: 220px;">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-calendar-check ml-1"></i> تحديد
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Requests Table Card -->
    <div class="card table-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">جدول الطلبات</h3>
                <div class="navbar-search" style="width: 250px;">
                    <i class="fas fa-search text-muted ml-2"></i>
                    <input type="text" placeholder="بحث..." id="searchRequest">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="40">
                                <input type="checkbox" class="check-all" onclick="toggleCheckboxes()">
                            </th>
                            <th>اسم العميل</th>
                            <th>رقم الهاتف</th>
                            <th>نوع العميل</th>
                            <th>الطلب</th>
                            <th>الحالة</th>
                            <th>الموعد</th>
                            <th width="100">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                        @php
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
                        <tr>
                            <td>
                                <input type="checkbox" class="check-item" name="selectedIds[]" value="{{ $request->id }}">
                            </td>
                            <td>
                                <a href="{{ route('requests.show', $request->id) }}" class="font-weight-bold text-primary">
                                    {{ $request->client_name }}
                                </a>
                            </td>
                            <td>
                                <a href="tel:{{ $request->client_phone }}" class="text-muted">
                                    <i class="fas fa-phone ml-1"></i>
                                    {{ $request->client_phone }}
                                </a>
                            </td>
                            <td>{{ $request->client_type }}</td>
                            <td>{{ $request->request_name }}</td>
                            <td>
                                <span class="status-badge {{ $statusColor == 'danger' ? 'inactive' : ($statusColor == 'success' ? 'active' : 'pending') }}">
                                    {{ $request->traking_client ?? 'جديد' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $event = \App\Models\Event::where('request_id', $request->id)->first();
                                @endphp
                                @if($event && isset($event->start))
                                    <span class="text-success">
                                        <i class="fas fa-calendar-alt ml-1"></i>
                                        {{ \Carbon\Carbon::parse($event->start)->locale('ar')->isoFormat('DD/MM h:mm a') }}
                                    </span>
                                @else
                                    <span class="text-muted">
                                        <i class="fas fa-clock ml-1"></i>
                                        لم يحدد
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('requests.show', $request->id) }}" class="btn btn-sm btn-info btn-icon" title="عرض">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('requests.destroy', $request->id) }}" method="post" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-icon" onclick="return confirm('هل أنت متأكد من الحذف؟')" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">لا توجد طلبات</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($requests->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $requests->links() }}
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    function applyAction() {
        var selectedIds = [];
        $('.check-item:checked').each(function() {
            selectedIds.push($(this).val());
        });
        $('#selectedIds').val(selectedIds.join(','));
    }

    function applyTime() {
        var selectedIdsTime = [];
        $('.check-item:checked').each(function() {
            selectedIdsTime.push($(this).val());
        });
        $('#selectedIdsTime').val(selectedIdsTime.join(','));
    }

    function toggleCheckboxes() {
        var checkAllCheckbox = document.querySelector('.check-all');
        var checkboxes = document.querySelectorAll('.check-item');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = checkAllCheckbox.checked;
        });
    }

    // Search functionality
    document.getElementById('searchRequest').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(function(row) {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    function displayMessage(message) {
        toastr.success(message, 'تم بنجاح');
    }
</script>
@endpush
