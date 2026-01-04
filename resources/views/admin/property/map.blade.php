@extends('admin.index')
@section('admin')

@php
use App\Models\Property;
$totalProperties = Property::count();
$availableCount = Property::where('status', 'Available')->count();
$soldCount = Property::where('status', 'Sold')->count();
$reservedCount = Property::where('status', 'Reserved')->count();
@endphp

<div class="col-12">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">خريطة العقارات</h4>
            <p class="text-muted mb-0">عرض جميع العقارات على الخريطة</p>
        </div>
        <div class="d-flex" style="gap: 10px;">
            <a href="{{ route('property.create.page') }}" class="btn btn-primary">
                <i class="fas fa-plus ml-2"></i> إضافة عقار
            </a>
            <a href="{{ route('properties.page') }}" class="btn btn-outline-secondary">
                <i class="fas fa-list ml-2"></i> عرض القائمة
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Map Section -->
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body p-0">
                    <div id="map" style="height: 650px; width: 100%; border-radius: 15px;"></div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-3">
            <!-- Stats Cards -->
            <div class="row mb-3">
                <div class="col-6">
                    <div class="card text-center" style="border-right: 4px solid #11760E;">
                        <div class="card-body py-3">
                            <h3 class="mb-0 font-weight-bold" style="color: #11760E;">{{ $totalProperties }}</h3>
                            <small class="text-muted">إجمالي العقارات</small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card text-center" style="border-right: 4px solid #1E85EE;">
                        <div class="card-body py-3">
                            <h3 class="mb-0 font-weight-bold" style="color: #1E85EE;">{{ $availableCount }}</h3>
                            <small class="text-muted">متاح</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-map-marker-alt text-danger ml-2"></i>
                        دليل الألوان
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <div class="legend-item d-flex align-items-center mb-3">
                        <span style="width: 20px; height: 20px; background: #11760E; border-radius: 50%; margin-left: 10px;"></span>
                        <span>متاح ({{ $availableCount }})</span>
                    </div>
                    <div class="legend-item d-flex align-items-center mb-3">
                        <span style="width: 20px; height: 20px; background: #dc3545; border-radius: 50%; margin-left: 10px;"></span>
                        <span>مباع ({{ $soldCount }})</span>
                    </div>
                    <div class="legend-item d-flex align-items-center">
                        <span style="width: 20px; height: 20px; background: #F9AB00; border-radius: 50%; margin-left: 10px;"></span>
                        <span>محجوز ({{ $reservedCount }})</span>
                    </div>
                </div>
            </div>

            <!-- Filter -->
            <div class="card mt-3">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-filter text-primary ml-2"></i>
                        تصفية العقارات
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <div class="form-group">
                        <label>حالة العقار</label>
                        <select class="form-control" id="filterStatus" onchange="filterMarkers()">
                            <option value="all">الكل</option>
                            <option value="Available">متاح</option>
                            <option value="Sold">مباع</option>
                            <option value="Reserved">محجوز</option>
                        </select>
                    </div>
                    <button class="btn btn-outline-primary btn-block" onclick="resetMap()">
                        <i class="fas fa-sync ml-2"></i> إعادة تعيين
                    </button>
                </div>
            </div>

            <!-- Properties List -->
            <div class="card mt-3">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-building text-success ml-2"></i>
                        العقارات
                    </h3>
                </div>
                <div class="card-body pt-0" style="max-height: 250px; overflow-y: auto;">
                    @foreach($places as $property)
                    <div class="property-list-item d-flex align-items-center p-2 mb-2"
                         style="background: #f8f9fa; border-radius: 10px; cursor: pointer;"
                         onclick="focusProperty({{ $property->latitude ?? 24.7136 }}, {{ $property->longitude ?? 46.6753 }}, {{ $property->id }})">
                        <div style="width: 12px; height: 12px; border-radius: 50%; margin-left: 10px;
                            background: {{ $property->status === 'Sold' ? '#dc3545' : ($property->status === 'Reserved' ? '#F9AB00' : '#11760E') }};"></div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0" style="font-size: 13px;">{{ Str::limit($property->name, 20) }}</h6>
                            <small class="text-muted">{{ number_format($property->price) }} ريال</small>
                        </div>
                        <i class="fas fa-chevron-left text-muted" style="font-size: 10px;"></i>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .property-list-item:hover {
        background: #e9ecef !important;
    }
    .gm-style-iw {
        direction: rtl;
    }
    .info-window {
        padding: 10px;
        min-width: 200px;
    }
    .info-window img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .info-window h5 {
        margin: 0 0 5px;
        font-size: 14px;
        font-weight: bold;
    }
    .info-window p {
        margin: 0 0 5px;
        font-size: 12px;
        color: #666;
    }
    .info-window .price {
        color: #11760E;
        font-weight: bold;
        font-size: 16px;
    }
    .info-window .btn {
        margin-top: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
    var map;
    var markers = [];
    var infoWindow;
    var properties = [
        @foreach($places as $property)
        @php
            $image = \App\Models\MultiImages::where('propery_id', $property->id)->first();
            $imagePath = $image ? asset('upload/property/multi_img/' . $image->images) : asset('placholder.png');
        @endphp
        {
            id: {{ $property->id }},
            name: "{{ $property->name }}",
            lat: {{ $property->latitude ?? 24.7136 }},
            lng: {{ $property->longitude ?? 46.6753 }},
            price: "{{ number_format($property->price) }}",
            location: "{{ $property->location ?? 'غير محدد' }}",
            area: "{{ $property->area ?? '-' }}",
            status: "{{ $property->status }}",
            image: "{{ $imagePath }}",
            url: "{{ route('property.show', $property->id) }}"
        },
        @endforeach
    ];

    function initMap() {
        // Default center (Riyadh)
        var defaultCenter = { lat: 24.7136, lng: 46.6753 };

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: defaultCenter,
            styles: [
                {
                    "featureType": "poi",
                    "elementType": "labels",
                    "stylers": [{ "visibility": "off" }]
                }
            ],
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                position: google.maps.ControlPosition.TOP_LEFT
            },
            fullscreenControl: true,
            streetViewControl: false
        });

        infoWindow = new google.maps.InfoWindow();

        // Create bounds to fit all markers
        var bounds = new google.maps.LatLngBounds();

        // Add markers for each property
        properties.forEach(function(property) {
            addMarker(property);
            if (property.lat && property.lng) {
                bounds.extend({ lat: property.lat, lng: property.lng });
            }
        });

        // Fit map to bounds if we have markers
        if (properties.length > 0) {
            map.fitBounds(bounds);

            // Don't zoom in too much
            var listener = google.maps.event.addListener(map, "idle", function() {
                if (map.getZoom() > 16) map.setZoom(16);
                google.maps.event.removeListener(listener);
            });
        }
    }

    function addMarker(property) {
        // Set marker color based on status
        var markerColor;
        switch(property.status) {
            case 'Sold':
                markerColor = '#dc3545';
                break;
            case 'Reserved':
                markerColor = '#F9AB00';
                break;
            default:
                markerColor = '#11760E';
        }

        var marker = new google.maps.Marker({
            position: { lat: property.lat, lng: property.lng },
            map: map,
            title: property.name,
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                fillColor: markerColor,
                fillOpacity: 1,
                strokeColor: '#ffffff',
                strokeWeight: 2,
                scale: 12
            },
            propertyData: property
        });

        // Create info window content
        var content = `
            <div class="info-window">
                <img src="${property.image}" alt="${property.name}" onerror="this.src='{{ asset('placholder.png') }}'">
                <h5>${property.name}</h5>
                <p><i class="fas fa-map-marker-alt text-danger"></i> ${property.location}</p>
                <p><i class="fas fa-ruler-combined text-success"></i> ${property.area} م²</p>
                <p class="price">${property.price} ريال</p>
                <span class="badge ${property.status === 'Sold' ? 'badge-danger' : (property.status === 'Reserved' ? 'badge-warning' : 'badge-success')}">
                    ${property.status === 'Sold' ? 'مباع' : (property.status === 'Reserved' ? 'محجوز' : 'متاح')}
                </span>
                <a href="${property.url}" class="btn btn-primary btn-sm btn-block">عرض التفاصيل</a>
            </div>
        `;

        marker.addListener('click', function() {
            infoWindow.setContent(content);
            infoWindow.open(map, marker);
        });

        markers.push(marker);
    }

    function filterMarkers() {
        var status = document.getElementById('filterStatus').value;

        markers.forEach(function(marker) {
            var property = marker.propertyData;
            if (status === 'all' || property.status === status) {
                marker.setVisible(true);
            } else {
                marker.setVisible(false);
            }
        });
    }

    function resetMap() {
        document.getElementById('filterStatus').value = 'all';
        filterMarkers();

        // Reset bounds
        var bounds = new google.maps.LatLngBounds();
        markers.forEach(function(marker) {
            marker.setVisible(true);
            bounds.extend(marker.getPosition());
        });
        map.fitBounds(bounds);
    }

    function focusProperty(lat, lng, id) {
        map.setCenter({ lat: lat, lng: lng });
        map.setZoom(17);

        // Find and click the marker
        markers.forEach(function(marker) {
            if (marker.propertyData.id === id) {
                google.maps.event.trigger(marker, 'click');
            }
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
@endpush
