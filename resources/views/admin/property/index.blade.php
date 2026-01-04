@extends('admin.index')
@section('admin')

<div class="col-12">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">قائمة العقارات</h4>
            <p class="text-muted mb-0">إدارة جميع العقارات المسجلة في النظام</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('property.map') }}" class="btn btn-outline-primary">
                <i class="fas fa-map-marker-alt ml-2"></i> عرض الخريطة
            </a>
            <a href="{{ route('property.create.page') }}" class="btn btn-primary">
                <i class="fas fa-plus ml-2"></i> إضافة عقار
            </a>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-value">{{ $properties->total() }}</div>
                        <div class="stat-label">إجمالي العقارات</div>
                    </div>
                    <div class="stat-icon green">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-value">{{ \App\Models\Property::where('status', 'Available')->count() }}</div>
                        <div class="stat-label">متاح للبيع</div>
                    </div>
                    <div class="stat-icon blue">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-value">{{ \App\Models\Property::where('status', 'Sold')->count() }}</div>
                        <div class="stat-label">مباع</div>
                    </div>
                    <div class="stat-icon red">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-value">{{ number_format(\App\Models\Property::sum('price')) }}</div>
                        <div class="stat-label">إجمالي القيمة (ريال)</div>
                    </div>
                    <div class="stat-icon yellow">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Properties Table Card -->
    <div class="card table-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h3 class="card-title">جدول العقارات</h3>
                <div class="d-flex gap-2 flex-wrap">
                    <!-- Search -->
                    <div class="navbar-search" style="width: 250px;">
                        <i class="fas fa-search text-muted ml-2"></i>
                        <input type="text" placeholder="بحث عن عقار..." id="searchProperty">
                    </div>
                    <!-- Filter by Status -->
                    <select class="form-control" id="filterStatus" style="width: 150px;">
                        <option value="">كل الحالات</option>
                        <option value="Available">متاح</option>
                        <option value="Sold">مباع</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover" id="propertiesTable">
                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th width="80">الصورة</th>
                            <th>اسم العقار</th>
                            <th>الموقع</th>
                            <th>المساحة</th>
                            <th>السعر</th>
                            <th>المالك</th>
                            <th>الحالة</th>
                            <th width="150">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properties as $index => $property)
                        <tr data-status="{{ $property->status }}">
                            <td>
                                <span class="font-weight-bold text-muted">{{ ($properties->currentPage() - 1) * $properties->perPage() + $index + 1 }}</span>
                            </td>
                            <td>
                                @if(isset($multiImages[$property->id]) && $multiImages[$property->id]->isNotEmpty())
                                    <img src="{{ asset('upload/property/multi_img/' . $multiImages[$property->id]->first()->images) }}"
                                         class="rounded" style="width: 60px; height: 45px; object-fit: cover;" alt="{{ $property->name }}">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 45px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('property.show', $property->id) }}" class="font-weight-bold text-primary">
                                    {{ $property->name }}
                                </a>
                                @if($property->number)
                                <br><small class="text-muted">رقم: {{ $property->number }}</small>
                                @endif
                            </td>
                            <td>
                                <i class="fas fa-map-marker-alt text-danger ml-1"></i>
                                {{ $property->location ?? $property->city ?? '-' }}
                            </td>
                            <td>
                                <i class="fas fa-ruler-combined text-success ml-1"></i>
                                {{ $property->area ?? '-' }} م²
                            </td>
                            <td>
                                <span class="font-weight-bold" style="color: var(--primary-dark);">
                                    {{ number_format($property->price) }}
                                </span>
                                <small class="text-muted">ريال</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary-light rounded-circle d-flex align-items-center justify-content-center ml-2" style="width: 30px; height: 30px;">
                                        <i class="fas fa-user text-primary" style="font-size: 12px;"></i>
                                    </div>
                                    <div>
                                        <span class="d-block">{{ $property->owner ?? '-' }}</span>
                                        @if($property->ophone)
                                        <small class="text-muted">{{ $property->ophone }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge {{ $property->status === 'Sold' ? 'inactive' : 'active' }}">
                                    <i class="fas {{ $property->status === 'Sold' ? 'fa-times-circle' : 'fa-check-circle' }} ml-1"></i>
                                    {{ __($property->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('property.show', $property->id) }}" class="btn btn-sm btn-info btn-icon" title="عرض">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('property.edit', $property->id) }}" class="btn btn-sm btn-warning btn-icon" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('property.destroy', $property->id) }}" method="post" class="d-inline">
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
                            <td colspan="9" class="text-center py-5">
                                <i class="fas fa-building fa-4x text-muted mb-3"></i>
                                <h5>لا توجد عقارات</h5>
                                <p class="text-muted">لم يتم إضافة أي عقارات بعد</p>
                                <a href="{{ route('property.create.page') }}" class="btn btn-primary">
                                    <i class="fas fa-plus ml-2"></i> إضافة عقار جديد
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Card Footer with Pagination -->
        @if($properties->hasPages())
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    عرض {{ $properties->firstItem() }} إلى {{ $properties->lastItem() }} من {{ $properties->total() }} عقار
                </div>
                <div>
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchProperty').addEventListener('keyup', function() {
        filterTable();
    });

    // Filter by status
    document.getElementById('filterStatus').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        const searchValue = document.getElementById('searchProperty').value.toLowerCase();
        const statusValue = document.getElementById('filterStatus').value;
        const rows = document.querySelectorAll('#propertiesTable tbody tr');

        rows.forEach(function(row) {
            const text = row.textContent.toLowerCase();
            const rowStatus = row.getAttribute('data-status');

            const matchesSearch = text.includes(searchValue);
            const matchesStatus = !statusValue || rowStatus === statusValue;

            row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
        });
    }
</script>
@endpush
