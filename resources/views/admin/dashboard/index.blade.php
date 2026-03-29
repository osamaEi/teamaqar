@extends('admin.index')
@section('admin')

<div class="col-12">

    <!-- ══════════════════════════════════════════════
         ROW 1 — KPI CARDS
    ══════════════════════════════════════════════ -->
    <div class="row mb-4">

        <!-- Total Properties -->
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="kpi-card">
                <div class="kpi-icon kpi-green"><i class="fas fa-building"></i></div>
                <div class="kpi-body">
                    <div class="kpi-value">{{ number_format($propertyCount) }}</div>
                    <div class="kpi-label">إجمالي العقارات</div>
                    <div class="kpi-sub">
                        <span class="text-success"><i class="fas fa-circle" style="font-size:8px;"></i> {{ $availableCount }} متاح</span>
                        <span class="text-danger mr-2"><i class="fas fa-circle" style="font-size:8px;"></i> {{ $soldCount }} مباع</span>
                        <span class="text-warning mr-2"><i class="fas fa-circle" style="font-size:8px;"></i> {{ $reservedCount }} محجوز</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Requests -->
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="kpi-card">
                <div class="kpi-icon kpi-orange"><i class="fas fa-clipboard-list"></i></div>
                <div class="kpi-body">
                    <div class="kpi-value">{{ number_format($requestCount) }}</div>
                    <div class="kpi-label">إجمالي الطلبات</div>
                    <div class="kpi-sub">
                        @if($newRequestsToday > 0)
                            <span class="badge badge-success">+{{ $newRequestsToday }} اليوم</span>
                        @else
                            <span class="text-muted">لا طلبات جديدة اليوم</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Today Events -->
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="kpi-card">
                <div class="kpi-icon kpi-purple"><i class="fas fa-calendar-check"></i></div>
                <div class="kpi-body">
                    <div class="kpi-value">{{ $todayEvents }}</div>
                    <div class="kpi-label">مواعيد اليوم</div>
                    <div class="kpi-sub">
                        @if($unreadEvents > 0)
                            <span class="badge badge-warning">{{ $unreadEvents }} غير مقروء</span>
                        @else
                            <span class="text-success"><i class="fas fa-check-circle"></i> كل شيء مقروء</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════════
         ROW 2 — MAP + TODAY TASKS
    ══════════════════════════════════════════════ -->
    <div class="row mb-4">

        <!-- Mini Map -->
        <div class="col-xl-8 mb-3">
            <div class="card h-100">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title"><i class="fas fa-map-marked-alt text-danger ml-2"></i>مواقع العقارات</h3>
                        <a href="{{ route('property.map') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-expand ml-1"></i> خريطة كاملة
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="dashMap" style="height:340px; border-radius:0 0 10px 10px;"></div>
                </div>
            </div>
        </div>

        <!-- Today's Tasks -->
        <div class="col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title"><i class="fas fa-tasks text-warning ml-2"></i>مواعيد اليوم</h3>
                        <a href="{{ route('calender.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-calendar-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @forelse($todayTasks as $task)
                    <div class="task-row {{ $task->read ? 'task-done' : '' }}">
                        <div class="task-check {{ $task->read ? 'checked' : '' }}">
                            @if($task->read)<i class="fas fa-check"></i>@endif
                        </div>
                        <div class="task-info flex-grow-1">
                            <div class="task-title">{{ $task->title }}</div>
                            <div class="task-time text-muted small">
                                <i class="far fa-clock ml-1"></i>
                                {{ \Carbon\Carbon::parse($task->start)->format('h:i A') }}
                            </div>
                        </div>
                        <span class="badge {{ $task->read ? 'badge-success' : 'badge-warning' }}">
                            {{ $task->read ? 'مكتمل' : 'قيد التنفيذ' }}
                        </span>
                    </div>
                    @empty
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-calendar-check fa-3x mb-3 text-success"></i>
                        <p class="mb-0">لا توجد مواعيد اليوم</p>
                    </div>
                    @endforelse
                </div>
                @if($todayTasks->count() > 0)
                <div class="card-footer bg-transparent text-center border-0 pt-0">
                    <a href="{{ route('calender.index') }}" class="btn btn-sm btn-light btn-block">
                        عرض جميع المواعيد
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════════
         ROW 3 — RECENT PROPERTIES + REQUESTS
    ══════════════════════════════════════════════ -->
    <div class="row mb-4">

        <!-- Recent Properties -->
        <div class="col-xl-7 mb-3">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title"><i class="fas fa-building text-success ml-2"></i>أحدث العقارات</h3>
                        <a href="{{ route('properties.page') }}" class="btn btn-sm btn-outline-success">عرض الكل</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>العقار</th>
                                <th>النوع</th>
                                <th>المدينة</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProperties as $p)
                            @php
                                $img = $p->multiImages->first();
                                $imgSrc = $img ? asset('upload/property/multi_img/'.$img->images) : asset('placholder.png');
                            @endphp
                            <tr onclick="window.location='{{ route('property.show', $p->id) }}'" style="cursor:pointer;">
                                <td>
                                    <div class="d-flex align-items-center" style="gap:10px;">
                                        <img src="{{ $imgSrc }}" style="width:40px;height:40px;object-fit:cover;border-radius:8px;" onerror="this.src='{{ asset('placholder.png') }}'">
                                        <div>
                                            <div class="font-weight-bold" style="font-size:13px;">{{ Str::limit($p->name, 22) }}</div>
                                            <div class="text-muted" style="font-size:11px;">{{ $p->area ? $p->area.' م²' : '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="small">{{ $p->property_type ?: '—' }}</span></td>
                                <td><span class="small">{{ $p->city ?: '—' }}</span></td>
                                <td>
                                    @if($p->status === 'Available')
                                        <span class="badge badge-success">متاح</span>
                                    @elseif($p->status === 'Sold')
                                        <span class="badge badge-danger">مباع</span>
                                    @else
                                        <span class="badge badge-warning">محجوز</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">لا توجد عقارات بعد</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Requests -->
        <div class="col-xl-5 mb-3">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title"><i class="fas fa-clipboard-list text-primary ml-2"></i>أحدث الطلبات</h3>
                        <a href="{{ route('requests.index') }}" class="btn btn-sm btn-outline-primary">عرض الكل</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>العميل</th>
                                <th>المدينة</th>
                                <th>نوع العميل</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRequests as $req)
                            <tr onclick="window.location='{{ route('requests.show', $req->id) }}'" style="cursor:pointer;">
                                <td>
                                    <div class="d-flex align-items-center" style="gap:8px;">
                                        <div class="req-avatar">{{ mb_substr($req->client_name ?? 'ع', 0, 1) }}</div>
                                        <span class="small font-weight-bold">{{ Str::limit($req->client_name ?? 'غير محدد', 18) }}</span>
                                    </div>
                                </td>
                                <td><span class="small">{{ $req->city ?: '—' }}</span></td>
                                <td>
                                    @php
                                        $typeMap = ['buyer'=>'مشتري','seller'=>'بائع','renter'=>'مستأجر','owner'=>'مالك'];
                                        $typeLabel = $typeMap[$req->client_type] ?? $req->client_type ?? '—';
                                    @endphp
                                    <span class="badge badge-light">{{ $typeLabel }}</span>
                                </td>
                                <td><span class="text-muted small">{{ $req->created_at->format('d/m') }}</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">لا توجد طلبات بعد</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════════
         ROW 4 — QUICK ACTIONS
    ══════════════════════════════════════════════ -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title"><i class="fas fa-bolt text-warning ml-2"></i>إجراءات سريعة</h3>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 col-md-2 mb-3">
                            <a href="{{ route('property.create.page') }}" class="quick-action">
                                <div class="qa-icon" style="background:#e8f5e9;color:#11760E;"><i class="fas fa-plus-circle"></i></div>
                                <div class="qa-label">إضافة عقار</div>
                            </a>
                        </div>
                        <div class="col-6 col-md-2 mb-3">
                            <a href="{{ route('requests.create') }}" class="quick-action">
                                <div class="qa-icon" style="background:#e3f2fd;color:#1E85EE;"><i class="fas fa-file-alt"></i></div>
                                <div class="qa-label">طلب جديد</div>
                            </a>
                        </div>
                        <div class="col-6 col-md-2 mb-3">
                            <a href="{{ route('property.map') }}" class="quick-action">
                                <div class="qa-icon" style="background:#fff3e0;color:#F9AB00;"><i class="fas fa-map-marked-alt"></i></div>
                                <div class="qa-label">الخريطة</div>
                            </a>
                        </div>
                        <div class="col-6 col-md-2 mb-3">
                            <a href="{{ route('calender.index') }}" class="quick-action">
                                <div class="qa-icon" style="background:#f3e5f5;color:#9c27b0;"><i class="fas fa-calendar-alt"></i></div>
                                <div class="qa-label">التقويم</div>
                            </a>
                        </div>
                        <div class="col-6 col-md-2 mb-3">
                            <a href="{{ route('files.index') }}" class="quick-action">
                                <div class="qa-icon" style="background:#fce4ec;color:#e91e63;"><i class="fas fa-folder-open"></i></div>
                                <div class="qa-label">الملفات</div>
                            </a>
                        </div>
                        <div class="col-6 col-md-2 mb-3">
                            <a href="{{ route('contacts.index') }}" class="quick-action">
                                <div class="qa-icon" style="background:#e0f7fa;color:#00bcd4;"><i class="fas fa-address-book"></i></div>
                                <div class="qa-label">جهات الاتصال</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>
/* ── KPI Cards ── */
.kpi-card {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    border: 1px solid #f0f0f0;
    height: 100%;
    transition: box-shadow .2s;
}
.kpi-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,.1); }
.kpi-icon {
    width: 52px; height: 52px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; flex-shrink: 0;
}
.kpi-green  { background: #e8f5e9; color: #11760E; }
.kpi-orange { background: #fff3e0; color: #ef6c00; }
.kpi-purple { background: #ede7f6; color: #6a1b9a; }
.kpi-body { flex: 1; min-width: 0; }
.kpi-value { font-size: 2rem; font-weight: 800; color: #0F302E; line-height: 1.1; }
.kpi-label { font-size: 13px; color: #888; margin: 3px 0 6px; }
.kpi-sub   { font-size: 12px; color: #666; }

/* ── Task rows ── */
.task-row {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 16px;
    border-bottom: 1px solid #f5f5f5;
    transition: background .15s;
}
.task-row:last-child { border-bottom: none; }
.task-row:hover { background: #fafafa; }
.task-row.task-done { opacity: .6; }
.task-check {
    width: 26px; height: 26px; border-radius: 50%;
    border: 2px solid #dee2e6;
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; flex-shrink: 0; color: transparent;
}
.task-check.checked { background: #11760E; border-color: #11760E; color: #fff; }
.task-title { font-size: 13px; font-weight: 600; color: #0F302E; }
.task-time { font-size: 11px; }

/* ── Request avatar ── */
.req-avatar {
    width: 32px; height: 32px; border-radius: 50%;
    background: linear-gradient(135deg, #0F302E, #1B8A8A);
    color: #fff; font-weight: 700; font-size: 14px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

/* ── Quick actions ── */
.quick-action { text-decoration: none; display: block; }
.quick-action:hover .qa-icon { transform: translateY(-4px); }
.qa-icon {
    width: 60px; height: 60px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; margin: 0 auto 8px;
    transition: transform .2s;
}
.qa-label { font-size: 12px; color: #555; font-weight: 600; }

/* ── Table hover rows ── */
.table tbody tr:hover { background: #f8fff8; }
</style>
@endpush

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initDashMap" async defer></script>
<script>
function initDashMap() {
    var el = document.getElementById('dashMap');
    if (!el) return;

    var map = new google.maps.Map(el, {
        center: { lat: 24.7136, lng: 46.6753 },
        zoom: 10,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false,
        zoomControlOptions: { position: google.maps.ControlPosition.LEFT_BOTTOM },
        styles: [{ featureType: 'poi', elementType: 'labels', stylers: [{ visibility: 'off' }] }]
    });

    var properties = @json($mapProperties);
    var infoWindow = new google.maps.InfoWindow();
    var bounds = new google.maps.LatLngBounds();
    var hasMarkers = false;

    properties.forEach(function(p) {
        if (!p.latitude || !p.longitude) return;
        var color = p.status === 'Sold' ? '#dc3545' : p.status === 'Reserved' ? '#F9AB00' : '#11760E';
        var pos = { lat: parseFloat(p.latitude), lng: parseFloat(p.longitude) };

        var marker = new google.maps.Marker({
            position: pos,
            map: map,
            title: p.name,
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                scale: 9,
                fillColor: color,
                fillOpacity: 0.95,
                strokeWeight: 2,
                strokeColor: '#fff'
            }
        });

        marker.addListener('click', function() {
            infoWindow.setContent(
                '<div style="font-family:Cairo;padding:6px;direction:rtl;">' +
                '<strong style="color:#0F302E;">' + p.name + '</strong>' +
                (p.city ? '<br><small style="color:#888;">' + p.city + '</small>' : '') +
                '<br><a href="/'+p.id+'/property" style="color:#1B8A8A;font-size:12px;">عرض التفاصيل ←</a>' +
                '</div>'
            );
            infoWindow.open(map, marker);
        });

        bounds.extend(pos);
        hasMarkers = true;
    });

    if (hasMarkers) {
        map.fitBounds(bounds);
        google.maps.event.addListenerOnce(map, 'idle', function() {
            if (map.getZoom() > 14) map.setZoom(14);
        });
    }
}
</script>
@endpush
