@extends('admin.index')
@section('admin')

<div class="col-12">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('properties.page') }}">العقارات</a></li>
                    <li class="breadcrumb-item active">{{ $property->name }}</li>
                </ol>
            </nav>
            <h4 class="mb-0 mt-2">تفاصيل العقار</h4>
        </div>
        <div class="d-flex" style="gap: 10px;">
            <a href="{{ route('property.edit', $property->id) }}" class="btn btn-warning">
                <i class="fas fa-edit ml-2"></i> تعديل
            </a>
            <form action="{{ route('property.destroy', $property->id) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                    <i class="fas fa-trash ml-2"></i> حذف
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- Right Column - Details (عرض أولاً في RTL) -->
        <div class="col-lg-5 order-lg-2">
            <!-- Price Card -->
            <div class="card bg-stat-dark-green text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1" style="opacity: 0.8;">السعر</p>
                            <h2 class="mb-0 font-weight-bold">{{ number_format($property->price) }}</h2>
                            <small style="opacity: 0.8;">ريال سعودي</small>
                        </div>
                        <div class="stat-icon" style="background: rgba(255,255,255,0.2);">
                            <i class="fas fa-tag"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Info Card -->
            <div class="card mt-4">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-building text-primary ml-2"></i>
                        معلومات العقار
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td class="text-muted" style="width: 40%;">اسم العقار</td>
                                <td class="font-weight-bold text-left">{{ $property->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">رقم العقار</td>
                                <td class="font-weight-bold text-left">{{ $property->number ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">نوع العقار</td>
                                <td class="font-weight-bold text-left">{{ $property->propery_cat ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">المساحة</td>
                                <td class="font-weight-bold text-left">
                                    <i class="fas fa-ruler-combined text-success ml-1"></i>
                                    {{ $property->area ?? '-' }} م²
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">حالة الأرض</td>
                                <td class="font-weight-bold text-left">{{ $property->land_situation ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">الموقع</td>
                                <td class="font-weight-bold text-left">
                                    <i class="fas fa-map-marker-alt text-danger ml-1"></i>
                                    {{ $property->location ?? '-' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Owner Info Card -->
            <div class="card mt-4">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-user text-info ml-2"></i>
                        معلومات المالك
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex align-items-center mb-3 p-3 bg-light" style="border-radius: 10px;">
                        <div class="ml-3" style="width: 50px; height: 50px; background: #0F302E; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 font-weight-bold">{{ $property->owner ?? 'غير محدد' }}</h6>
                            <small class="text-muted">{{ $property->owner_status ?? 'مالك العقار' }}</small>
                        </div>
                    </div>

                    @if($property->ophone)
                    <a href="tel:{{ $property->ophone }}" class="btn btn-outline-primary btn-block mb-2">
                        <i class="fas fa-phone ml-2"></i>
                        {{ $property->ophone }}
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $property->ophone) }}" target="_blank" class="btn btn-success btn-block">
                        <i class="fab fa-whatsapp ml-2"></i>
                        تواصل عبر واتساب
                    </a>
                    @endif
                </div>
            </div>

            <!-- Mediators Card -->
            @if($property->mediator1 || $property->mediator2)
            <div class="card mt-4">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-users text-warning ml-2"></i>
                        الوسطاء
                    </h3>
                </div>
                <div class="card-body pt-0">
                    @if($property->mediator1)
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light mb-2" style="border-radius: 10px;">
                        <div class="d-flex align-items-center">
                            <div class="ml-3" style="width: 40px; height: 40px; background: #1E85EE; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-tie text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $property->mediator1 }}</h6>
                                <small class="text-muted">{{ $property->phone1 ?? '' }}</small>
                            </div>
                        </div>
                        @if($property->phone1)
                        <a href="tel:{{ $property->phone1 }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-phone"></i>
                        </a>
                        @endif
                    </div>
                    @endif

                    @if($property->mediator2)
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light" style="border-radius: 10px;">
                        <div class="d-flex align-items-center">
                            <div class="ml-3" style="width: 40px; height: 40px; background: #11760E; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-tie text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $property->mediator2 }}</h6>
                                <small class="text-muted">{{ $property->phone2 ?? '' }}</small>
                            </div>
                        </div>
                        @if($property->phone2)
                        <a href="tel:{{ $property->phone2 }}" class="btn btn-sm btn-success">
                            <i class="fas fa-phone"></i>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Left Column - Images & Map -->
        <div class="col-lg-7 order-lg-1">
            <!-- Images Card -->
            <div class="card">
                <div class="card-body p-0 position-relative">
                    <!-- Status Badge -->
                    <div class="position-absolute" style="top: 15px; right: 15px; z-index: 10;">
                        <span class="badge {{ $property->status === 'Sold' ? 'bg-danger' : 'bg-success' }} px-3 py-2" style="font-size: 14px;">
                            <i class="fas {{ $property->status === 'Sold' ? 'fa-times-circle' : 'fa-check-circle' }} ml-1"></i>
                            {{ $property->status === 'Sold' ? 'مباع' : 'متاح' }}
                        </span>
                    </div>

                    @if(isset($multiImage) && count($multiImage) > 0)
                        <!-- Main Image -->
                        <div style="position: relative;">
                            <img id="mainImage" src="{{ asset('upload/property/multi_img/' . $multiImage[0]->images) }}"
                                 class="w-100" style="height: 400px; object-fit: cover; border-radius: 15px 15px 0 0;" alt="{{ $property->name }}"
                                 onerror="this.onerror=null; this.src='{{ asset('placholder.png') }}'">

                            @if(count($multiImage) > 1)
                            <!-- Navigation Arrows -->
                            <button class="btn btn-light position-absolute" style="top: 50%; right: 15px; transform: translateY(-50%); width: 40px; height: 40px; border-radius: 50%; padding: 0;" onclick="prevImage()">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <button class="btn btn-light position-absolute" style="top: 50%; left: 15px; transform: translateY(-50%); width: 40px; height: 40px; border-radius: 50%; padding: 0;" onclick="nextImage()">
                                <i class="fas fa-chevron-left"></i>
                            </button>

                            <!-- Image Counter -->
                            <div class="position-absolute bg-dark text-white px-3 py-1" style="bottom: 15px; left: 15px; border-radius: 20px; opacity: 0.8; font-size: 14px;">
                                <span id="currentImageNum">1</span> / {{ count($multiImage) }}
                            </div>
                            @endif
                        </div>

                        <!-- Thumbnails -->
                        @if(count($multiImage) > 1)
                        <div class="p-3">
                            <div class="d-flex" style="gap: 10px; overflow-x: auto;">
                                @foreach($multiImage as $index => $image)
                                <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}"
                                     onclick="changeImage('{{ asset('upload/property/multi_img/' . $image->images) }}', {{ $index }})"
                                     style="cursor: pointer; border-radius: 10px; overflow: hidden; border: 3px solid {{ $index === 0 ? '#0F302E' : 'transparent' }}; flex-shrink: 0; transition: all 0.3s; width: 80px; height: 60px; background: #f0f0f0;">
                                    <img src="{{ asset('upload/property/multi_img/' . $image->images) }}"
                                         style="width: 100%; height: 100%; object-fit: cover;"
                                         alt="صورة {{ $index + 1 }}"
                                         onerror="this.onerror=null; this.src='{{ asset('placholder.png') }}';">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @else
                        <!-- No Image Placeholder -->
                        <img src="{{ asset('placholder.png') }}" class="w-100" style="height: 400px; object-fit: cover; border-radius: 15px;" alt="لا توجد صورة">
                    @endif
                </div>
            </div>

            <!-- Map Card -->
            <div class="card mt-4">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-map-marker-alt text-danger ml-2"></i>
                        موقع العقار
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div id="map" style="height: 300px; width: 100%; border-radius: 0 0 15px 15px;"></div>
                </div>
            </div>

            <!-- Description Card -->
            @if($property->description)
            <div class="card mt-4">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-align-right text-primary ml-2"></i>
                        الوصف
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <p class="mb-0" style="line-height: 1.8;">{{ $property->description }}</p>
                </div>
            </div>
            @endif

            <!-- Notes Card -->
            @if($property->notes)
            <div class="card mt-4">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-sticky-note text-warning ml-2"></i>
                        ملاحظات
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <p class="mb-0">{{ $property->notes }}</p>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <a href="{{ route('property.edit', $property->id) }}" class="btn btn-outline-warning btn-block text-center py-3">
                                <i class="fas fa-edit fa-lg d-block mb-2"></i>
                                <small>تعديل</small>
                            </a>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-outline-info btn-block text-center py-3" onclick="window.print()">
                                <i class="fas fa-print fa-lg d-block mb-2"></i>
                                <small>طباعة</small>
                            </button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-outline-success btn-block text-center py-3" onclick="shareProperty()">
                                <i class="fas fa-share-alt fa-lg d-block mb-2"></i>
                                <small>مشاركة</small>
                            </button>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('properties.page') }}" class="btn btn-outline-primary btn-block text-center py-3">
                                <i class="fas fa-arrow-right fa-lg d-block mb-2"></i>
                                <small>رجوع</small>
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
    .thumbnail-item:hover {
        border-color: #1a5c3a !important;
    }
    .thumbnail-item.active {
        border-color: #0F302E !important;
    }
    @media print {
        .btn, .main-sidebar, .main-header, .main-footer, .card-header {
            display: none !important;
        }
        .content-wrapper {
            margin: 0 !important;
        }
    }
    @media (max-width: 991px) {
        .order-lg-1, .order-lg-2 {
            order: unset !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>

<script>
    var currentImageIndex = 0;
    var images = @json(isset($multiImage) && $multiImage ? $multiImage->pluck('images')->toArray() : []);
    var baseUrl = "{{ asset('upload/property/multi_img/') }}/";

    function initMap() {
        var lat = {{ $property->latitude ?? 24.7136 }};
        var lng = {{ $property->longitude ?? 46.6753 }};

        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: lat, lng: lng },
            zoom: 15
        });

        var marker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map,
            title: '{{ $property->name }}'
        });
    }

    function changeImage(src, index) {
        document.getElementById('mainImage').src = src;
        currentImageIndex = index;
        var counter = document.getElementById('currentImageNum');
        if (counter) counter.textContent = index + 1;

        // Update thumbnails
        document.querySelectorAll('.thumbnail-item').forEach(function(item, i) {
            item.style.borderColor = (i === index) ? '#0F302E' : 'transparent';
        });
    }

    function nextImage() {
        if (images.length === 0) return;
        currentImageIndex = (currentImageIndex + 1) % images.length;
        changeImage(baseUrl + images[currentImageIndex], currentImageIndex);
    }

    function prevImage() {
        if (images.length === 0) return;
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        changeImage(baseUrl + images[currentImageIndex], currentImageIndex);
    }

    function shareProperty() {
        var text = 'عقار: {{ $property->name }}\nالموقع: {{ $property->location }}\nالسعر: {{ number_format($property->price) }} ريال\n' + window.location.href;

        if (navigator.share) {
            navigator.share({
                title: '{{ $property->name }}',
                text: text,
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(text).then(function() {
                alert('تم نسخ معلومات العقار');
            });
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowRight') prevImage();
        if (e.key === 'ArrowLeft') nextImage();
    });
</script>
@endpush
