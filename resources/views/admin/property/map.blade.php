@extends('admin.index')
@section('admin')

@php
use App\Models\Property;
$totalProperties    = Property::count();
$availableCount     = Property::where('status', 'Available')->count();
$soldCount          = Property::where('status', 'Sold')->count();
$reservedCount      = Property::where('status', 'Reserved')->count();
$propertyTypes      = Property::whereNotNull('property_type')->distinct()->pluck('property_type');
$maxPrice           = Property::max('price') ?: 1000000;
@endphp

<div class="col-12">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">خريطة العقارات</h4>
            <p class="text-muted mb-0">عرض وتصفية جميع العقارات على الخريطة</p>
        </div>
        <div class="d-flex" style="gap:10px;">
            <button class="btn btn-outline-info btn-sm" onclick="printMap()" title="طباعة">
                <i class="fas fa-print ml-1"></i> طباعة
            </button>
            <a href="{{ route('property.create.page') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus ml-1"></i> إضافة عقار
            </a>
            <a href="{{ route('properties.page') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-list ml-1"></i> القائمة
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Map -->
        <div class="col-lg-9">
            <div class="card p-0 overflow-hidden" style="border-radius:16px;">
                <div class="position-relative">
                    <div id="map" style="height:680px; width:100%;"></div>

                    <!-- Map Type Toggle (top-left overlay) -->
                    <div class="map-type-bar">
                        <button id="btnRoad"    class="map-type-btn active" onclick="setMapType('roadmap')">
                            <i class="fas fa-road"></i> خريطة
                        </button>
                        <button id="btnSat"     class="map-type-btn" onclick="setMapType('satellite')">
                            <i class="fas fa-satellite"></i> قمر صناعي
                        </button>
                        <button id="btnTerrain" class="map-type-btn" onclick="setMapType('terrain')">
                            <i class="fas fa-mountain"></i> تضاريس
                        </button>
                    </div>

                    <!-- Quick action buttons (bottom-right) -->
                    <div class="map-actions">
                        <button class="map-action-btn" onclick="goToMyLocation()" title="موقعي الحالي">
                            <i class="fas fa-crosshairs"></i>
                        </button>
                        <button class="map-action-btn" onclick="fitAllMarkers()" title="عرض كل العقارات">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </button>
                        <button class="map-action-btn" onclick="toggleHeatmap()" title="خريطة الكثافة" id="heatmapBtn">
                            <i class="fas fa-fire"></i>
                        </button>
                    </div>

                    <!-- Drawing Tools -->
                    <div id="drawingTools" class="drawing-tools">
                        <button type="button" class="draw-btn" id="drawPolygon" title="رسم منطقة">
                            <i class="fas fa-draw-polygon"></i>
                        </button>
                        <button type="button" class="draw-btn" id="drawCircle" title="رسم دائرة">
                            <i class="far fa-circle"></i>
                        </button>
                        <button type="button" class="draw-btn" id="drawRectangle" title="رسم مستطيل">
                            <i class="far fa-square"></i>
                        </button>
                        <button type="button" class="draw-btn" id="drawMarker" title="إضافة علامة">
                            <i class="fas fa-map-marker-alt"></i>
                        </button>
                        <button type="button" class="draw-btn draw-btn-danger" id="clearDrawing" title="مسح">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Save Drawing Card -->
            <div class="card mt-3" id="saveDrawingCard" style="display:none;">
                <div class="card-header bg-success text-white border-0">
                    <h3 class="card-title mb-0"><i class="fas fa-save ml-2"></i> حفظ المنطقة المرسومة</h3>
                </div>
                <div class="card-body">
                    <form id="saveDrawingForm">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>اسم المنطقة</label>
                                    <input type="text" class="form-control" id="drawingName" placeholder="مثال: حي النخيل">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>اللون</label>
                                    <input type="color" class="form-control" id="drawingColor" value="#11760E" style="height:38px;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ملاحظات</label>
                                    <input type="text" class="form-control" id="drawingNotes" placeholder="ملاحظات...">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="drawingCoords">
                        <input type="hidden" id="drawingType">
                        <div class="d-flex" style="gap:10px;">
                            <button type="button" class="btn btn-success" onclick="saveDrawing()">
                                <i class="fas fa-save ml-1"></i> حفظ
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="cancelDrawing()">
                                <i class="fas fa-times ml-1"></i> إلغاء
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-3">

            <!-- Stats (2x2 grid) -->
            <div class="row mb-3 no-gutters" style="gap:0;">
                <div class="col-6 pr-1 pb-2">
                    <div class="stat-mini" style="border-color:#0F302E;">
                        <div class="stat-mini-num" style="color:#0F302E;">{{ $totalProperties }}</div>
                        <div class="stat-mini-lbl">إجمالي</div>
                    </div>
                </div>
                <div class="col-6 pl-1 pb-2">
                    <div class="stat-mini" style="border-color:#11760E;">
                        <div class="stat-mini-num" style="color:#11760E;">{{ $availableCount }}</div>
                        <div class="stat-mini-lbl">متاح</div>
                    </div>
                </div>
                <div class="col-6 pr-1">
                    <div class="stat-mini" style="border-color:#dc3545;">
                        <div class="stat-mini-num" style="color:#dc3545;">{{ $soldCount }}</div>
                        <div class="stat-mini-lbl">مباع</div>
                    </div>
                </div>
                <div class="col-6 pl-1">
                    <div class="stat-mini" style="border-color:#F9AB00;">
                        <div class="stat-mini-num" style="color:#F9AB00;">{{ $reservedCount }}</div>
                        <div class="stat-mini-lbl">محجوز</div>
                    </div>
                </div>
            </div>

            <!-- Search -->
            <div class="card mb-3">
                <div class="card-body py-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput"
                               placeholder="بحث باسم العقار..."
                               oninput="applyFilters()">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="card mb-3">
                <div class="card-header border-0 py-2">
                    <h3 class="card-title mb-0" style="font-size:14px;">
                        <i class="fas fa-filter text-primary ml-1"></i> تصفية العقارات
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <!-- Status -->
                    <div class="form-group mb-2">
                        <label class="small font-weight-bold">الحالة</label>
                        <select class="form-control form-control-sm" id="filterStatus" onchange="applyFilters()">
                            <option value="all">الكل</option>
                            <option value="Available">متاح</option>
                            <option value="Sold">مباع</option>
                            <option value="Reserved">محجوز</option>
                        </select>
                    </div>

                    <!-- Property Type -->
                    <div class="form-group mb-2">
                        <label class="small font-weight-bold">نوع العقار</label>
                        <select class="form-control form-control-sm" id="filterType" onchange="applyFilters()">
                            <option value="all">الكل</option>
                            @foreach($propertyTypes as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="form-group mb-2">
                        <label class="small font-weight-bold">
                            السعر: <span id="priceRangeLabel">0 - {{ number_format($maxPrice) }}</span> ريال
                        </label>
                        <input type="range" class="custom-range" id="priceMin"
                               min="0" max="{{ $maxPrice }}" value="0" step="10000"
                               oninput="updatePriceLabel(); applyFilters()">
                        <input type="range" class="custom-range" id="priceMax"
                               min="0" max="{{ $maxPrice }}" value="{{ $maxPrice }}" step="10000"
                               oninput="updatePriceLabel(); applyFilters()">
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex" style="gap:8px;">
                        <button class="btn btn-outline-secondary btn-sm flex-fill" onclick="resetFilters()">
                            <i class="fas fa-sync ml-1"></i> إعادة تعيين
                        </button>
                        <button class="btn btn-primary btn-sm flex-fill" onclick="fitAllMarkers()">
                            <i class="fas fa-expand ml-1"></i> عرض الكل
                        </button>
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="card mb-3">
                <div class="card-header border-0 py-2">
                    <h3 class="card-title mb-0" style="font-size:14px;">
                        <i class="fas fa-circle-info ml-1 text-info"></i> دليل الألوان
                    </h3>
                </div>
                <div class="card-body pt-0 pb-2">
                    <div class="d-flex align-items-center mb-2">
                        <span class="legend-dot" style="background:#11760E;"></span>
                        <span class="small">متاح ({{ $availableCount }})</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="legend-dot" style="background:#dc3545;"></span>
                        <span class="small">مباع ({{ $soldCount }})</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="legend-dot" style="background:#F9AB00;"></span>
                        <span class="small">محجوز ({{ $reservedCount }})</span>
                    </div>
                </div>
            </div>

            <!-- Properties List -->
            <div class="card">
                <div class="card-header border-0 py-2 d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0" style="font-size:14px;">
                        <i class="fas fa-building text-success ml-1"></i> العقارات
                    </h3>
                    <span class="badge badge-secondary" id="visibleCount">{{ $totalProperties }}</span>
                </div>
                <div class="card-body pt-0 px-2" style="max-height:280px; overflow-y:auto;" id="propertyListContainer">
                    @foreach($places as $property)
                    @php
                        $color = $property->status === 'Sold' ? '#dc3545' : ($property->status === 'Reserved' ? '#F9AB00' : '#11760E');
                    @endphp
                    <div class="prop-list-item"
                         data-id="{{ $property->id }}"
                         data-status="{{ $property->status }}"
                         data-type="{{ $property->property_type }}"
                         data-price="{{ $property->price }}"
                         data-name="{{ strtolower($property->name) }}"
                         onclick="focusProperty({{ $property->latitude ?? 24.7136 }}, {{ $property->longitude ?? 46.6753 }}, {{ $property->id }})">
                        <i class="fas fa-home prop-icon" style="color:{{ $color }};"></i>
                        <div class="flex-grow-1 min-width-0">
                            <div class="prop-name">{{ Str::limit($property->name, 20) }}</div>
                            <div class="prop-meta">
                                {{ number_format($property->price) }} ريال
                                @if($property->area) · {{ $property->area }} م²@endif
                            </div>
                        </div>
                        <i class="fas fa-chevron-left prop-arrow"></i>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Drawing Tools Info -->
            <div class="card mt-3">
                <div class="card-header border-0 py-2">
                    <h3 class="card-title mb-0" style="font-size:14px;">
                        <i class="fas fa-pencil-alt text-warning ml-1"></i> أدوات الرسم
                    </h3>
                </div>
                <div class="card-body pt-0 pb-2">
                    <div class="draw-info-item"><i class="fas fa-draw-polygon"></i> رسم منطقة حرة</div>
                    <div class="draw-info-item"><i class="far fa-circle"></i> رسم دائرة</div>
                    <div class="draw-info-item"><i class="far fa-square"></i> رسم مستطيل</div>
                    <div class="draw-info-item"><i class="fas fa-map-marker-alt"></i> إضافة علامة</div>
                    <div class="draw-info-item text-danger"><i class="fas fa-trash"></i> مسح الرسومات</div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
/* ---- Stats ---- */
.stat-mini {
    background: #fff;
    border-right: 4px solid #ccc;
    border-radius: 10px;
    padding: 12px 10px;
    text-align: center;
    box-shadow: 0 1px 6px rgba(0,0,0,.06);
}
.stat-mini-num { font-size: 1.6rem; font-weight: 800; line-height: 1; }
.stat-mini-lbl { font-size: 11px; color: #888; margin-top: 3px; }

/* ---- Map overlays ---- */
.map-type-bar {
    position: absolute;
    top: 10px;
    left: 10px;
    z-index: 999;
    display: flex;
    gap: 4px;
    background: rgba(255,255,255,.95);
    border-radius: 10px;
    padding: 5px;
    box-shadow: 0 2px 12px rgba(0,0,0,.2);
}
.map-type-btn {
    border: none;
    background: transparent;
    padding: 6px 12px;
    border-radius: 7px;
    font-size: 12px;
    font-family: 'Cairo', sans-serif;
    cursor: pointer;
    color: #444;
    transition: all .2s;
}
.map-type-btn.active { background: #0F302E; color: #fff; }
.map-type-btn:not(.active):hover { background: #f0f0f0; }

.map-actions {
    position: absolute;
    bottom: 90px;
    left: 10px;
    z-index: 999;
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.map-action-btn {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    border: none;
    background: rgba(255,255,255,.95);
    box-shadow: 0 2px 10px rgba(0,0,0,.2);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    color: #0F302E;
    transition: all .2s;
}
.map-action-btn:hover { background: #0F302E; color: #fff; }
.map-action-btn.active-heat { background: #ff6b35; color: #fff; }

/* ---- Drawing tools ---- */
.drawing-tools {
    position: absolute;
    top: 10px;
    right: 60px;
    z-index: 999;
    display: flex;
    flex-direction: column;
    gap: 0;
}
.draw-btn {
    width: 44px;
    height: 44px;
    border: 1px solid #dee2e6;
    background: rgba(255,255,255,.95);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 15px;
    color: #444;
    transition: all .2s;
}
.draw-btn:first-child { border-radius: 10px 10px 0 0; }
.draw-btn:last-child  { border-radius: 0 0 10px 10px; }
.draw-btn:hover:not(.active) { background: #f0f0f0; }
.draw-btn.active { background: #0F302E; color: #fff; border-color: #0F302E; }
.draw-btn-danger { color: #dc3545; }
.draw-btn-danger:hover { background: #dc3545 !important; color: #fff !important; }

/* ---- Property list ---- */
.prop-list-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 9px 10px;
    border-radius: 10px;
    cursor: pointer;
    transition: background .2s;
    margin-bottom: 4px;
}
.prop-list-item:hover { background: #f0f4f0; }
.prop-icon { font-size: 15px; flex-shrink: 0; }
.prop-name { font-size: 13px; font-weight: 600; color: #0F302E; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.prop-meta { font-size: 11px; color: #888; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.prop-arrow { font-size: 10px; color: #ccc; flex-shrink: 0; }
.prop-list-item.hidden { display: none; }

/* ---- Legend dot ---- */
.legend-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-left: 8px;
    flex-shrink: 0;
}

/* ---- Drawing info ---- */
.draw-info-item {
    font-size: 12px;
    color: #666;
    padding: 4px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.draw-info-item i { width: 16px; text-align: center; color: #0F302E; }

/* ---- InfoWindow ---- */
.gm-style-iw { direction: rtl; }
.iw-wrap { padding: 8px 4px; min-width: 230px; max-width: 260px; }
.iw-img { width: 100%; height: 130px; object-fit: cover; border-radius: 10px; margin-bottom: 10px; }
.iw-name { font-size: 15px; font-weight: 700; color: #0F302E; margin: 0 0 6px; }
.iw-row { font-size: 12px; color: #666; margin: 3px 0; display: flex; align-items: center; gap: 6px; }
.iw-price { font-size: 18px; font-weight: 800; color: #11760E; margin: 10px 0 6px; }

/* ---- Range sliders ---- */
.custom-range { width: 100%; margin-bottom: 4px; }
</style>
@endpush

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=drawing,visualization" async defer></script>

<script>
    var map, infoWindow, drawingManager, heatmap;
    var markers = [];
    var currentShape = null;
    var drawnShapes = [];
    var heatmapActive = false;

    var properties = [
        @foreach($places as $property)
        @php
            $image = \App\Models\MultiImages::where('propery_id', $property->id)->first();
            $imagePath = $image ? asset('upload/property/multi_img/' . $image->images) : asset('placholder.png');
        @endphp
        {
            id: {{ $property->id }},
            name: @json($property->name),
            lat: {{ $property->latitude ?? 24.7136 }},
            lng: {{ $property->longitude ?? 46.6753 }},
            price: {{ $property->price ?? 0 }},
            priceFormatted: "{{ number_format($property->price) }}",
            location: @json($property->location ?? 'غير محدد'),
            area: "{{ $property->area ?? '-' }}",
            status: "{{ $property->status }}",
            propertyType: @json($property->property_type ?? ''),
            city: @json($property->city ?? ''),
            image: "{{ $imagePath }}",
            url: "{{ route('property.show', $property->id) }}"
        },
        @endforeach
    ];

    /* =================== MARKER ICON =================== */
    function getHouseIcon(color) {
        return {
            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 56" width="42" height="50">' +
                '<defs><filter id="sh"><feDropShadow dx="0" dy="3" stdDeviation="2.5" flood-opacity="0.35"/></filter></defs>' +
                '<circle cx="24" cy="24" r="22" fill="white" filter="url(#sh)"/>' +
                '<path d="M24 10 L11 21 L11 35 L37 35 L37 21 Z" fill="' + color + '"/>' +
                '<rect x="19" y="27" width="10" height="8" fill="white" rx="1"/>' +
                '<polygon points="24,5 7,20 11,20 24,10 37,20 41,20" fill="' + color + '"/>' +
                '<circle cx="24" cy="50" r="4" fill="' + color + '" opacity="0.4"/>' +
                '</svg>'
            ),
            scaledSize: new google.maps.Size(42, 50),
            anchor: new google.maps.Point(21, 48)
        };
    }

    function statusColor(status) {
        return status === 'Sold' ? '#dc3545' : status === 'Reserved' ? '#F9AB00' : '#11760E';
    }

    function statusLabel(status) {
        return status === 'Sold' ? 'مباع' : status === 'Reserved' ? 'محجوز' : 'متاح';
    }

    function statusBadge(status) {
        return status === 'Sold' ? 'danger' : status === 'Reserved' ? 'warning' : 'success';
    }

    /* =================== INIT MAP =================== */
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: { lat: 24.7136, lng: 46.6753 },
            mapTypeControl: false,
            fullscreenControl: true,
            fullscreenControlOptions: { position: google.maps.ControlPosition.TOP_RIGHT },
            streetViewControl: true,
            streetViewControlOptions: { position: google.maps.ControlPosition.RIGHT_BOTTOM },
            zoomControlOptions: { position: google.maps.ControlPosition.RIGHT_CENTER },
            styles: [{ featureType: "poi", elementType: "labels", stylers: [{ visibility: "off" }] }]
        });

        infoWindow = new google.maps.InfoWindow({ maxWidth: 270 });

        // Heatmap
        heatmap = new google.maps.visualization.HeatmapLayer({
            data: [],
            map: null,
            radius: 40,
            opacity: 0.7,
            gradient: ['rgba(0,255,0,0)', 'rgba(0,255,0,1)', 'rgba(255,255,0,1)', 'rgba(255,0,0,1)']
        });

        // Drawing manager
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: null,
            drawingControl: false,
            polygonOptions:   { fillColor: '#0F302E', fillOpacity: 0.25, strokeColor: '#0F302E', strokeWeight: 2, editable: true, draggable: true },
            circleOptions:    { fillColor: '#1E85EE', fillOpacity: 0.25, strokeColor: '#1E85EE', strokeWeight: 2, editable: true, draggable: true },
            rectangleOptions: { fillColor: '#F9AB00', fillOpacity: 0.25, strokeColor: '#F9AB00', strokeWeight: 2, editable: true, draggable: true },
            markerOptions:    { draggable: true }
        });
        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
            currentShape = event.overlay;
            drawnShapes.push(event.overlay);
            drawingManager.setDrawingMode(null);
            document.querySelectorAll('.draw-btn').forEach(b => b.classList.remove('active'));
            document.getElementById('saveDrawingCard').style.display = 'block';
            document.getElementById('drawingType').value = event.type;
            document.getElementById('drawingCoords').value = JSON.stringify(getShapeCoordinates(event.type, event.overlay));
        });

        // Add all markers
        var bounds = new google.maps.LatLngBounds();
        var heatPoints = [];
        properties.forEach(function(p) {
            addMarker(p);
            bounds.extend({ lat: p.lat, lng: p.lng });
            heatPoints.push(new google.maps.LatLng(p.lat, p.lng));
        });
        heatmap.setData(heatPoints);

        if (properties.length > 0) {
            map.fitBounds(bounds);
            var l = google.maps.event.addListener(map, 'idle', function() {
                if (map.getZoom() > 15) map.setZoom(15);
                google.maps.event.removeListener(l);
            });
        }

        setupDrawingTools();
    }

    /* =================== ADD MARKER =================== */
    function addMarker(p) {
        var marker = new google.maps.Marker({
            position: { lat: p.lat, lng: p.lng },
            map: map,
            title: p.name,
            icon: getHouseIcon(statusColor(p.status)),
            animation: google.maps.Animation.DROP,
            propertyData: p
        });

        marker.addListener('click', function() {
            var content = `
                <div class="iw-wrap">
                    <img class="iw-img" src="${p.image}" alt="${p.name}" onerror="this.src='{{ asset('placholder.png') }}'">
                    <p class="iw-name">${p.name}</p>
                    ${p.city ? '<div class="iw-row"><i class="fas fa-city text-info"></i> ' + p.city + '</div>' : ''}
                    <div class="iw-row"><i class="fas fa-map-marker-alt text-danger"></i> ${p.location}</div>
                    <div class="iw-row"><i class="fas fa-ruler-combined text-primary"></i> ${p.area} م²</div>
                    ${p.propertyType ? '<div class="iw-row"><i class="fas fa-home text-success"></i> ' + p.propertyType + '</div>' : ''}
                    <div class="iw-price">${p.priceFormatted} ريال</div>
                    <span class="badge badge-${statusBadge(p.status)}">${statusLabel(p.status)}</span>
                    <div class="mt-2 d-flex" style="gap:6px;">
                        <a href="${p.url}" class="btn btn-primary btn-sm flex-fill">
                            <i class="fas fa-eye ml-1"></i> التفاصيل
                        </a>
                        <a href="/properties/${p.id}/edit" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>`;
            infoWindow.setContent(content);
            infoWindow.open(map, marker);
        });

        markers.push(marker);
    }

    /* =================== MAP TYPE =================== */
    function setMapType(type) {
        map.setMapTypeId(type);
        document.querySelectorAll('.map-type-btn').forEach(b => b.classList.remove('active'));
        document.getElementById(type === 'roadmap' ? 'btnRoad' : type === 'satellite' ? 'btnSat' : 'btnTerrain').classList.add('active');
    }

    /* =================== HEATMAP =================== */
    function toggleHeatmap() {
        heatmapActive = !heatmapActive;
        heatmap.setMap(heatmapActive ? map : null);
        document.getElementById('heatmapBtn').classList.toggle('active-heat', heatmapActive);
    }

    /* =================== LOCATION =================== */
    function goToMyLocation() {
        if (!navigator.geolocation) return;
        navigator.geolocation.getCurrentPosition(function(pos) {
            var latLng = { lat: pos.coords.latitude, lng: pos.coords.longitude };
            map.setCenter(latLng);
            map.setZoom(15);
            new google.maps.Marker({
                position: latLng,
                map: map,
                title: 'موقعك الحالي',
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 10,
                    fillColor: '#4285F4',
                    fillOpacity: 1,
                    strokeColor: 'white',
                    strokeWeight: 3
                }
            });
        });
    }

    /* =================== FIT ALL =================== */
    function fitAllMarkers() {
        var bounds = new google.maps.LatLngBounds();
        var visible = markers.filter(m => m.getVisible());
        if (visible.length === 0) return;
        visible.forEach(m => bounds.extend(m.getPosition()));
        map.fitBounds(bounds);
    }

    /* =================== FILTERS =================== */
    function updatePriceLabel() {
        var min = parseInt(document.getElementById('priceMin').value);
        var max = parseInt(document.getElementById('priceMax').value);
        document.getElementById('priceRangeLabel').textContent =
            Number(min).toLocaleString('ar') + ' - ' + Number(max).toLocaleString('ar');
    }

    function applyFilters() {
        var status  = document.getElementById('filterStatus').value;
        var type    = document.getElementById('filterType').value;
        var search  = document.getElementById('searchInput').value.toLowerCase().trim();
        var priceMin = parseInt(document.getElementById('priceMin').value);
        var priceMax = parseInt(document.getElementById('priceMax').value);

        var visibleCount = 0;
        markers.forEach(function(marker) {
            var p = marker.propertyData;
            var show = true;

            if (status !== 'all' && p.status !== status) show = false;
            if (type !== 'all' && p.propertyType !== type) show = false;
            if (search && !p.name.toLowerCase().includes(search)) show = false;
            if (p.price < priceMin || p.price > priceMax) show = false;

            marker.setVisible(show);
            if (show) visibleCount++;

            // Sync property list
            var listItem = document.querySelector('.prop-list-item[data-id="' + p.id + '"]');
            if (listItem) listItem.classList.toggle('hidden', !show);
        });

        document.getElementById('visibleCount').textContent = visibleCount;
    }

    function resetFilters() {
        document.getElementById('filterStatus').value = 'all';
        document.getElementById('filterType').value = 'all';
        document.getElementById('searchInput').value = '';
        document.getElementById('priceMin').value = 0;
        document.getElementById('priceMax').value = {{ $maxPrice }};
        updatePriceLabel();
        applyFilters();
        fitAllMarkers();
    }

    /* =================== FOCUS PROPERTY =================== */
    function focusProperty(lat, lng, id) {
        map.setCenter({ lat: lat, lng: lng });
        map.setZoom(17);
        markers.forEach(function(marker) {
            if (marker.propertyData.id === id) {
                google.maps.event.trigger(marker, 'click');
                marker.setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(function() { marker.setAnimation(null); }, 1500);
            }
        });
    }

    /* =================== DRAWING =================== */
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
        document.getElementById('clearDrawing').addEventListener('click', clearAllDrawings);
    }

    function setDrawingMode(mode, btn) {
        document.querySelectorAll('.draw-btn').forEach(b => b.classList.remove('active'));
        if (drawingManager.getDrawingMode() === mode) {
            drawingManager.setDrawingMode(null);
        } else {
            drawingManager.setDrawingMode(mode);
            btn.classList.add('active');
        }
    }

    function getShapeCoordinates(type, shape) {
        var coords = {};
        if (type === 'polygon') {
            var path = shape.getPath();
            coords.points = [];
            for (var i = 0; i < path.getLength(); i++) {
                coords.points.push({ lat: path.getAt(i).lat(), lng: path.getAt(i).lng() });
            }
        } else if (type === 'circle') {
            coords.center = { lat: shape.getCenter().lat(), lng: shape.getCenter().lng() };
            coords.radius = shape.getRadius();
        } else if (type === 'rectangle') {
            var b = shape.getBounds();
            coords.bounds = { north: b.getNorthEast().lat(), south: b.getSouthWest().lat(), east: b.getNorthEast().lng(), west: b.getSouthWest().lng() };
        } else if (type === 'marker') {
            coords.position = { lat: shape.getPosition().lat(), lng: shape.getPosition().lng() };
        }
        return coords;
    }

    function clearAllDrawings() {
        drawnShapes.forEach(s => s.setMap(null));
        drawnShapes = [];
        currentShape = null;
        document.getElementById('saveDrawingCard').style.display = 'none';
        document.getElementById('saveDrawingForm').reset();
    }

    function saveDrawing() {
        var name = document.getElementById('drawingName').value;
        if (!name) { toastr.error('يرجى إدخال اسم للمنطقة'); return; }

        $.ajax({
            url: '{{ route("map.drawing.save") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: name,
                color: document.getElementById('drawingColor').value,
                notes: document.getElementById('drawingNotes').value,
                coordinates: document.getElementById('drawingCoords').value,
                type: document.getElementById('drawingType').value
            },
            success: function() {
                toastr.success('تم حفظ المنطقة بنجاح');
                var color = document.getElementById('drawingColor').value;
                if (currentShape && currentShape.setOptions) {
                    currentShape.setOptions({ fillColor: color, strokeColor: color });
                }
                document.getElementById('saveDrawingCard').style.display = 'none';
                document.getElementById('saveDrawingForm').reset();
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

    /* =================== PRINT =================== */
    function printMap() { window.print(); }
</script>
@endpush
