@extends('admin.index')
@section('admin')

@php
use Carbon\Carbon;

// Statistics
$propertyCount = \App\Models\Property::count();
$requestCount = \App\Models\RequestProperty::count();

$today = Carbon::now()->startOfDay();
$remindersTodayCount = \App\Models\Event::whereDate('start', '=', $today)
    ->where('read', false)
    ->count();

$allreminders = \App\Models\Event::where('read', false)->count();

$mediator1Count = \App\Models\Property::whereNotNull('mediator1')->distinct('mediator1')->count('mediator1');
$mediator2Count = \App\Models\Property::whereNotNull('mediator2')->distinct('mediator2')->count('mediator2');
$totalMediators = $mediator1Count + $mediator2Count;

$twoWeeksAgo = Carbon::now()->subWeeks(2);
$latestPropertyCount = \App\Models\Property::where('created_at', '>=', $twoWeeksAgo)->count();
$latestRequestCount = \App\Models\RequestProperty::where('created_at', '>=', $twoWeeksAgo)->count();

// Get recent properties
$recentProperties = \App\Models\Property::latest()->take(5)->get();

// Get today's tasks/events
$todayTasks = \App\Models\Event::whereDate('start', '=', $today)->take(4)->get();

// Get recent requests
$recentRequests = \App\Models\RequestProperty::latest()->take(5)->get();

// Get properties for map
$mapProperties = \App\Models\Property::whereNotNull('latitude')->whereNotNull('longitude')->take(20)->get();

// Monthly stats for chart
$monthlyStats = [];
for ($i = 11; $i >= 0; $i--) {
    $month = Carbon::now()->subMonths($i);
    $monthlyStats[] = [
        'month' => $month->translatedFormat('M'),
        'properties' => \App\Models\Property::whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->count(),
        'requests' => \App\Models\RequestProperty::whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->count()
    ];
}
@endphp

<div class="col-12">
    <!-- Stats Cards Row -->
    <div class="row">
        <!-- Properties Count -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-icon green">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-value">{{ $propertyCount }}</div>
                        <div class="stat-label">مقتابع مفعلة</div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+{{ $latestPropertyCount }} جديد</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-icon blue">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-value">84,500</div>
                        <div class="stat-label">ريال إجمالي السيارة</div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-chart-line"></i>
                        <span>7318.5k</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Requests -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-icon red">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="stat-value">{{ $requestCount }}</div>
                        <div class="stat-label">طلبات</div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+{{ $latestRequestCount }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today Tasks -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-icon yellow">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stat-value">{{ $remindersTodayCount }}</div>
                        <div class="stat-label">مهام اليوم</div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-clock"></i>
                        <span>{{ $allreminders }} الكل</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row: Chart & Top Performer -->
    <div class="row mt-4">
        <!-- Sales Chart -->
        <div class="col-lg-8">
            <div class="chart-card card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">إحصائيات المبيعات</h3>
                        <div class="chart-tabs">
                            <button class="tab active">اليوم</button>
                            <button class="tab">أسبوع</button>
                            <button class="tab">شهر</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Performer -->
        <div class="col-lg-4">
            <div class="performer-card card">
                <div class="card-header border-0">
                    <h3 class="card-title">أفضل المسوقين</h3>
                </div>
                <div class="card-body text-center">
                    <div class="performer-image">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" alt="Top Performer">
                    </div>
                    <h4 class="performer-name">أحمد محمد</h4>
                    <p class="performer-role">مسوق عقاري</p>
                    <div class="performer-stats">
                        <div class="performer-stat">
                            <div class="value">{{ $propertyCount }}</div>
                            <div class="label">عقار</div>
                        </div>
                        <div class="performer-stat">
                            <div class="value">{{ $requestCount }}</div>
                            <div class="label">طلب</div>
                        </div>
                        <div class="performer-stat">
                            <div class="value">{{ $totalMediators }}</div>
                            <div class="label">صفقة</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Third Row: Map & Tasks -->
    <div class="row mt-4">
        <!-- Map -->
        <div class="col-lg-8">
            <div class="map-card card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title"><i class="fas fa-search ml-2"></i> أحدث العقارات</h3>
                        <div class="map-legend">
                            <div class="map-legend-item">
                                <span class="dot green"></span>
                                <span>المدن</span>
                            </div>
                            <div class="map-legend-item">
                                <span class="dot blue"></span>
                                <span>مكتمل</span>
                            </div>
                            <div class="map-legend-item">
                                <span class="dot yellow"></span>
                                <span>متقدمين</span>
                            </div>
                            <div class="map-legend-item">
                                <span class="dot red"></span>
                                <span>رجال</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="propertiesMap" class="map-container"></div>
                </div>
            </div>
        </div>

        <!-- Today's Tasks -->
        <div class="col-lg-4">
            <div class="todo-card card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">مهام اليوم</h3>
                        <div class="d-flex gap-2">
                            <span class="badge bg-success-light text-success rounded-pill px-3">{{ $todayTasks->count() }}</span>
                            <button class="btn btn-sm btn-icon btn-outline-primary">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($todayTasks as $task)
                    <div class="todo-item {{ $task->read ? 'completed' : '' }}">
                        <div class="todo-checkbox {{ $task->read ? 'checked' : '' }}">
                            @if($task->read)
                            <i class="fas fa-check"></i>
                            @endif
                        </div>
                        <span class="todo-text">{{ $task->title }}</span>
                        <span class="todo-status {{ $task->read ? 'completed' : 'pending' }}">
                            {{ $task->read ? 'مكتمل' : 'قيد التنفيذ' }}
                        </span>
                    </div>
                    @empty
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-check-circle fa-3x mb-3"></i>
                        <p>لا توجد مهام لهذا اليوم</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Reminders -->
            <div class="reminder-card card mt-4">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">تنبيهات</h3>
                        <button class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="reminder-item">
                        <div class="reminder-icon warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="reminder-content">
                            <div class="reminder-title">تجديد عقد العمل مالا طاري</div>
                            <div class="reminder-time">منذ ساعة</div>
                        </div>
                        <div class="reminder-action">
                            <button class="btn-icon check"><i class="fas fa-check"></i></button>
                            <button class="btn-icon add"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="reminder-item">
                        <div class="reminder-icon success">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="reminder-content">
                            <div class="reminder-title">رهن جديد فيلا في الرياض</div>
                            <div class="reminder-time">منذ 3 ساعات</div>
                        </div>
                        <div class="reminder-action">
                            <button class="btn-icon check"><i class="fas fa-check"></i></button>
                            <button class="btn-icon add"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fourth Row: Recent Tables -->
    <div class="row mt-4">
        <!-- Recent Properties Today -->
        <div class="col-lg-6">
            <div class="card table-card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">حضر المتأخل مجدد اليوم</h3>
                        <div class="d-flex gap-2">
                            <span class="badge bg-success rounded-circle" style="width: 24px; height: 24px;"></span>
                            <span class="badge bg-warning rounded-circle" style="width: 24px; height: 24px;"></span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <tbody>
                            @forelse($recentProperties->take(3) as $property)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-{{ $loop->iteration == 1 ? 'danger' : ($loop->iteration == 2 ? 'success' : 'info') }} rounded-circle ml-2" style="width: 10px; height: 10px;"></span>
                                        <span>{{ $property->name ?? 'عقار جديد' }}</span>
                                    </div>
                                </td>
                                <td class="text-muted">{{ $property->city ?? 'الرياض' }}</td>
                                <td>
                                    <img src="{{ asset('dist/img/user1-128x128.jpg') }}" class="img-circle" style="width: 30px; height: 30px;">
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">لا توجد عقارات</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Requests Today -->
        <div class="col-lg-6">
            <div class="card table-card">
                <div class="card-header border-0">
                    <h3 class="card-title">أخر الطلبات اليوم</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>الإسم والإيجي</th>
                                <th>للحجوزة</th>
                                <th>تأش</th>
                                <th>الاطلاع الجانبي</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRequests->take(3) as $request)
                            <tr>
                                <td>
                                    <span class="badge bg-{{ $loop->iteration == 1 ? 'danger' : 'warning' }} rounded-circle ml-2" style="width: 8px; height: 8px;"></span>
                                    {{ $request->city ?? 'طلب جديد' }}
                                </td>
                                <td>{{ $request->price ?? '0' }}</td>
                                <td>{{ $request->created_at ? $request->created_at->format('H:i') : '--' }}</td>
                                <td>
                                    <div class="table-user">
                                        <img src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="User">
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">لا توجد طلبات</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Fifth Row: Properties & Communications -->
    <div class="row mt-4">
        <!-- Today's Properties -->
        <div class="col-lg-6">
            <div class="card table-card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">عروضات عقار موم اليوم</h3>
                        <button class="btn btn-sm btn-info">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>المندوب - المباحث</th>
                                <th>اقرار</th>
                                <th>ذلربهجة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProperties->take(2) as $property)
                            <tr>
                                <td>{{ $property->name ?? 'عقار' }}</td>
                                <td>{{ $property->price ?? '0' }}</td>
                                <td>{{ $property->created_at ? $property->created_at->format('d/m') : '--' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">لا توجد عقارات</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Communications -->
        <div class="col-lg-6">
            <div class="card table-card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">أخر الطلبات والمخاطبيات</h3>
                        <button class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="activity-item">
                        <div class="activity-icon green">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">تسجيد عقد السيجان - اتخطية - متوضعة ماتقز</div>
                        </div>
                        <span class="badge bg-danger-light text-danger">جديد</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon blue">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">كرم مجيد تلقهار - كواش المجاد في</div>
                        </div>
                        <span class="badge bg-success-light text-success">مكتمل</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>

<script>
// Sales Chart
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($monthlyStats, 'month')) !!},
            datasets: [{
                label: 'العقارات',
                data: {!! json_encode(array_column($monthlyStats, 'properties')) !!},
                backgroundColor: '#11760E',
                borderRadius: 5,
                barThickness: 20,
            }, {
                label: 'الطلبات',
                data: {!! json_encode(array_column($monthlyStats, 'requests')) !!},
                backgroundColor: '#1E85EE',
                borderRadius: 5,
                barThickness: 20,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            family: 'Cairo'
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: 'Cairo'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f0f0f0'
                    },
                    ticks: {
                        font: {
                            family: 'Cairo'
                        }
                    }
                }
            }
        }
    });
});

// Google Maps
function initMap() {
    const mapElement = document.getElementById('propertiesMap');
    if (!mapElement) return;

    const map = new google.maps.Map(mapElement, {
        center: { lat: 24.7136, lng: 46.6753 }, // Riyadh
        zoom: 10,
        styles: [
            {
                "featureType": "all",
                "elementType": "geometry.fill",
                "stylers": [{"weight": "2.00"}]
            },
            {
                "featureType": "all",
                "elementType": "geometry.stroke",
                "stylers": [{"color": "#9c9c9c"}]
            },
            {
                "featureType": "all",
                "elementType": "labels.text",
                "stylers": [{"visibility": "on"}]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [{"color": "#aadaff"}]
            }
        ]
    });

    // Add markers for properties
    const properties = @json($mapProperties);
    const bounds = new google.maps.LatLngBounds();

    properties.forEach(function(property, index) {
        if (property.latitude && property.longitude) {
            const position = { lat: parseFloat(property.latitude), lng: parseFloat(property.longitude) };

            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: property.name || 'عقار',
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 10,
                    fillColor: index % 4 === 0 ? '#11760E' : (index % 4 === 1 ? '#1E85EE' : (index % 4 === 2 ? '#F9AB00' : '#F54F68')),
                    fillOpacity: 0.9,
                    strokeWeight: 2,
                    strokeColor: '#ffffff'
                }
            });

            bounds.extend(position);

            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div style="padding: 10px; font-family: Cairo;">
                        <h5 style="margin: 0 0 5px;">${property.name || 'عقار'}</h5>
                        <p style="margin: 0; color: #666;">${property.city || ''}</p>
                    </div>
                `
            });

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });
        }
    });

    if (properties.length > 0) {
        map.fitBounds(bounds);
    }
}
</script>
@endpush
