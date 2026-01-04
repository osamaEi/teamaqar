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
                <div class="card-body p-0 position-relative">
                    <div id="map" style="height: 650px; width: 100%; border-radius: 15px;"></div>

                    <!-- Drawing Tools -->
                    <div id="drawingTools" class="position-absolute" style="top: 10px; right: 60px; z-index: 1000;">
                        <div class="btn-group-vertical shadow" role="group">
                            <button type="button" class="btn btn-light" id="drawPolygon" title="رسم منطقة">
                                <i class="fas fa-draw-polygon"></i>
                            </button>
                            <button type="button" class="btn btn-light" id="drawCircle" title="رسم دائرة">
                                <i class="fas fa-circle"></i>
                            </button>
                            <button type="button" class="btn btn-light" id="drawRectangle" title="رسم مستطيل">
                                <i class="fas fa-square"></i>
                            </button>
                            <button type="button" class="btn btn-light" id="drawMarker" title="إضافة علامة">
                                <i class="fas fa-map-marker-alt"></i>
                            </button>
                            <button type="button" class="btn btn-danger" id="clearDrawing" title="مسح الرسم">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Drawing Card -->
            <div class="card mt-3" id="saveDrawingCard" style="display: none;">
                <div class="card-header border-0 bg-success text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-save ml-2"></i>
                        حفظ المنطقة المرسومة
                    </h3>
                </div>
                <div class="card-body">
                    <form id="saveDrawingForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>اسم المنطقة</label>
                                    <input type="text" class="form-control" id="drawingName" placeholder="مثال: حي النخيل">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>اللون</label>
                                    <input type="color" class="form-control" id="drawingColor" value="#11760E" style="height: 38px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>ملاحظات</label>
                            <textarea class="form-control" id="drawingNotes" rows="2" placeholder="ملاحظات إضافية..."></textarea>
                        </div>
                        <input type="hidden" id="drawingCoords">
                        <input type="hidden" id="drawingType">
                        <div class="d-flex" style="gap: 10px;">
                            <button type="button" class="btn btn-success" onclick="saveDrawing()">
                                <i class="fas fa-save ml-2"></i> حفظ
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="cancelDrawing()">
                                <i class="fas fa-times ml-2"></i> إلغاء
                            </button>
                        </div>
                    </form>
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
                        <i class="fas fa-home text-success ml-2"></i>
                        دليل الألوان
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <div class="legend-item d-flex align-items-center mb-3">
                        <i class="fas fa-home ml-2" style="color: #11760E; font-size: 18px;"></i>
                        <span>متاح ({{ $availableCount }})</span>
                    </div>
                    <div class="legend-item d-flex align-items-center mb-3">
                        <i class="fas fa-home ml-2" style="color: #dc3545; font-size: 18px;"></i>
                        <span>مباع ({{ $soldCount }})</span>
                    </div>
                    <div class="legend-item d-flex align-items-center">
                        <i class="fas fa-home ml-2" style="color: #F9AB00; font-size: 18px;"></i>
                        <span>محجوز ({{ $reservedCount }})</span>
                    </div>
                </div>
            </div>

            <!-- Drawing Tools Info -->
            <div class="card mt-3">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-pencil-alt text-info ml-2"></i>
                        أدوات الرسم
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <small class="text-muted d-block mb-2">
                        <i class="fas fa-draw-polygon ml-1"></i> رسم منطقة حرة
                    </small>
                    <small class="text-muted d-block mb-2">
                        <i class="fas fa-circle ml-1"></i> رسم دائرة
                    </small>
                    <small class="text-muted d-block mb-2">
                        <i class="fas fa-square ml-1"></i> رسم مستطيل
                    </small>
                    <small class="text-muted d-block">
                        <i class="fas fa-map-marker-alt ml-1"></i> إضافة علامة جديدة
                    </small>
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
                <div class="card-body pt-0" style="max-height: 200px; overflow-y: auto;">
                    @foreach($places as $property)
                    <div class="property-list-item d-flex align-items-center p-2 mb-2"
                         style="background: #f8f9fa; border-radius: 10px; cursor: pointer;"
                         onclick="focusProperty({{ $property->latitude ?? 24.7136 }}, {{ $property->longitude ?? 46.6753 }}, {{ $property->id }})">
                        <i class="fas fa-home ml-2" style="color: {{ $property->status === 'Sold' ? '#dc3545' : ($property->status === 'Reserved' ? '#F9AB00' : '#11760E') }};"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-0" style="font-size: 13px;">{{ Str::limit($property->name, 18) }}</h6>
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
        min-width: 220px;
    }
    .info-window img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .info-window h5 {
        margin: 0 0 8px;
        font-size: 15px;
        font-weight: bold;
        color: #0F302E;
    }
    .info-window p {
        margin: 0 0 5px;
        font-size: 12px;
        color: #666;
    }
    .info-window .price {
        color: #11760E;
        font-weight: bold;
        font-size: 18px;
        margin: 10px 0;
    }
    .info-window .btn {
        margin-top: 10px;
    }
    #drawingTools .btn {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0;
        border: 1px solid #dee2e6;
    }
    #drawingTools .btn:first-child {
        border-radius: 10px 10px 0 0;
    }
    #drawingTools .btn:last-child {
        border-radius: 0 0 10px 10px;
    }
    #drawingTools .btn.active {
        background: #0F302E;
        color: white;
    }
    #drawingTools .btn:hover:not(.active) {
        background: #f8f9fa;
    }
    .house-marker {
        background: white;
        border-radius: 50%;
        padding: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
</style>
@endpush

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=drawing" async defer></script>

<script>
    var map;
    var markers = [];
    var infoWindow;
    var drawingManager;
    var currentShape = null;
    var drawnShapes = [];

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
            propertyType: "{{ $property->property_type ?? '' }}",
            image: "{{ $imagePath }}",
            url: "{{ route('property.show', $property->id) }}"
        },
        @endforeach
    ];

    // Custom house marker SVG
    function getHouseIcon(color) {
        return {
            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="40" height="40">
                    <defs>
                        <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
                            <feDropShadow dx="0" dy="2" stdDeviation="2" flood-opacity="0.3"/>
                        </filter>
                    </defs>
                    <circle cx="24" cy="24" r="20" fill="white" filter="url(#shadow)"/>
                    <path d="M24 10 L12 20 L12 34 L36 34 L36 20 Z" fill="${color}"/>
                    <rect x="20" y="26" width="8" height="8" fill="white"/>
                    <polygon points="24,6 8,20 12,20 24,10 36,20 40,20" fill="${color}"/>
                </svg>
            `),
            scaledSize: new google.maps.Size(45, 45),
            anchor: new google.maps.Point(22, 22)
        };
    }

    function initMap() {
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

        // Initialize Drawing Manager
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: null,
            drawingControl: false,
            polygonOptions: {
                fillColor: '#11760E',
                fillOpacity: 0.3,
                strokeColor: '#11760E',
                strokeWeight: 2,
                editable: true,
                draggable: true
            },
            circleOptions: {
                fillColor: '#1E85EE',
                fillOpacity: 0.3,
                strokeColor: '#1E85EE',
                strokeWeight: 2,
                editable: true,
                draggable: true
            },
            rectangleOptions: {
                fillColor: '#F9AB00',
                fillOpacity: 0.3,
                strokeColor: '#F9AB00',
                strokeWeight: 2,
                editable: true,
                draggable: true
            },
            markerOptions: {
                draggable: true
            }
        });
        drawingManager.setMap(map);

        // Drawing complete event
        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
            currentShape = event.overlay;
            drawnShapes.push(event.overlay);
            drawingManager.setDrawingMode(null);

            // Remove active class from buttons
            document.querySelectorAll('#drawingTools .btn').forEach(btn => btn.classList.remove('active'));

            // Show save card
            document.getElementById('saveDrawingCard').style.display = 'block';
            document.getElementById('drawingType').value = event.type;

            // Get coordinates based on shape type
            var coords = getShapeCoordinates(event.type, event.overlay);
            document.getElementById('drawingCoords').value = JSON.stringify(coords);
        });

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

            var listener = google.maps.event.addListener(map, "idle", function() {
                if (map.getZoom() > 16) map.setZoom(16);
                google.maps.event.removeListener(listener);
            });
        }

        // Setup drawing tool buttons
        setupDrawingTools();
    }

    function setupDrawingTools() {
        document.getElementById('drawPolygon').addEventListener('click', function() {
            setDrawingMode(google.maps.drawing.OverlayType.POLYGON, this);
        });

        document.getElementById('drawCircle').addEventListener('click', function() {
            setDrawingMode(google.maps.drawing.OverlayType.CIRCLE, this);
        });

        document.getElementById('drawRectangle').addEventListener('click', function() {
            setDrawingMode(google.maps.drawing.OverlayType.RECTANGLE, this);
        });

        document.getElementById('drawMarker').addEventListener('click', function() {
            setDrawingMode(google.maps.drawing.OverlayType.MARKER, this);
        });

        document.getElementById('clearDrawing').addEventListener('click', function() {
            clearAllDrawings();
        });
    }

    function setDrawingMode(mode, btn) {
        // Remove active class from all buttons
        document.querySelectorAll('#drawingTools .btn').forEach(b => b.classList.remove('active'));

        // Toggle drawing mode
        if (drawingManager.getDrawingMode() === mode) {
            drawingManager.setDrawingMode(null);
        } else {
            drawingManager.setDrawingMode(mode);
            btn.classList.add('active');
        }
    }

    function getShapeCoordinates(type, shape) {
        var coords = {};

        switch(type) {
            case google.maps.drawing.OverlayType.POLYGON:
                var path = shape.getPath();
                coords.points = [];
                for (var i = 0; i < path.getLength(); i++) {
                    coords.points.push({
                        lat: path.getAt(i).lat(),
                        lng: path.getAt(i).lng()
                    });
                }
                break;
            case google.maps.drawing.OverlayType.CIRCLE:
                coords.center = {
                    lat: shape.getCenter().lat(),
                    lng: shape.getCenter().lng()
                };
                coords.radius = shape.getRadius();
                break;
            case google.maps.drawing.OverlayType.RECTANGLE:
                var bounds = shape.getBounds();
                coords.bounds = {
                    north: bounds.getNorthEast().lat(),
                    south: bounds.getSouthWest().lat(),
                    east: bounds.getNorthEast().lng(),
                    west: bounds.getSouthWest().lng()
                };
                break;
            case google.maps.drawing.OverlayType.MARKER:
                coords.position = {
                    lat: shape.getPosition().lat(),
                    lng: shape.getPosition().lng()
                };
                break;
        }

        return coords;
    }

    function clearAllDrawings() {
        drawnShapes.forEach(function(shape) {
            shape.setMap(null);
        });
        drawnShapes = [];
        currentShape = null;
        document.getElementById('saveDrawingCard').style.display = 'none';
        document.getElementById('saveDrawingForm').reset();
    }

    function saveDrawing() {
        var name = document.getElementById('drawingName').value;
        var color = document.getElementById('drawingColor').value;
        var notes = document.getElementById('drawingNotes').value;
        var coords = document.getElementById('drawingCoords').value;
        var type = document.getElementById('drawingType').value;

        if (!name) {
            toastr.error('يرجى إدخال اسم للمنطقة');
            return;
        }

        // Save to server
        $.ajax({
            url: '{{ route("map.drawing.save") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: name,
                color: color,
                notes: notes,
                coordinates: coords,
                type: type
            },
            success: function(response) {
                toastr.success('تم حفظ المنطقة بنجاح');
                document.getElementById('saveDrawingCard').style.display = 'none';
                document.getElementById('saveDrawingForm').reset();

                // Update shape color
                if (currentShape && currentShape.setOptions) {
                    currentShape.setOptions({
                        fillColor: color,
                        strokeColor: color
                    });
                }
            },
            error: function() {
                toastr.info('تم حفظ الرسم محلياً');
                document.getElementById('saveDrawingCard').style.display = 'none';
            }
        });
    }

    function cancelDrawing() {
        if (currentShape) {
            currentShape.setMap(null);
            drawnShapes = drawnShapes.filter(s => s !== currentShape);
            currentShape = null;
        }
        document.getElementById('saveDrawingCard').style.display = 'none';
        document.getElementById('saveDrawingForm').reset();
    }

    function addMarker(property) {
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
            icon: getHouseIcon(markerColor),
            animation: google.maps.Animation.DROP,
            propertyData: property
        });

        var statusText = property.status === 'Sold' ? 'مباع' : (property.status === 'Reserved' ? 'محجوز' : 'متاح');
        var statusClass = property.status === 'Sold' ? 'badge-danger' : (property.status === 'Reserved' ? 'badge-warning' : 'badge-success');

        var content = `
            <div class="info-window">
                <img src="${property.image}" alt="${property.name}" onerror="this.src='{{ asset('placholder.png') }}'">
                <h5>${property.name}</h5>
                <p><i class="fas fa-map-marker-alt text-danger"></i> ${property.location}</p>
                <p><i class="fas fa-ruler-combined text-primary"></i> ${property.area} م²</p>
                ${property.propertyType ? '<p><i class="fas fa-home text-success"></i> ' + property.propertyType + '</p>' : ''}
                <p class="price">${property.price} ريال</p>
                <span class="badge ${statusClass}">${statusText}</span>
                <a href="${property.url}" class="btn btn-primary btn-sm btn-block">
                    <i class="fas fa-eye ml-1"></i> عرض التفاصيل
                </a>
            </div>
        `;

        marker.addListener('click', function() {
            infoWindow.setContent(content);
            infoWindow.open(map, marker);
        });

        // Add hover effect
        marker.addListener('mouseover', function() {
            marker.setAnimation(google.maps.Animation.BOUNCE);
            setTimeout(function() {
                marker.setAnimation(null);
            }, 500);
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

        markers.forEach(function(marker) {
            if (marker.propertyData.id === id) {
                google.maps.event.trigger(marker, 'click');
                marker.setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(function() {
                    marker.setAnimation(null);
                }, 1500);
            }
        });
    }
</script>
@endpush
