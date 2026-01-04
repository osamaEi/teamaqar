@extends('admin.index')
@section('admin')

<div class="col-12">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('properties.page') }}">العقارات</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('property.show', $property->id) }}">{{ $property->name }}</a></li>
                    <li class="breadcrumb-item active">تعديل</li>
                </ol>
            </nav>
            <h4 class="mb-0 mt-2">تعديل العقار</h4>
        </div>
        <a href="{{ route('property.show', $property->id) }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-right ml-2"></i> رجوع
        </a>
    </div>

    <form action="{{ route('properties.update', $property->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Right Column - Main Info -->
            <div class="col-lg-8">
                <!-- Basic Info Card -->
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-building text-primary ml-2"></i>
                            المعلومات الأساسية
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">اسم العقار <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $property->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="number">رقم العقار</label>
                                    <input type="text" name="number" class="form-control" id="number" value="{{ $property->number }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="area">المساحة (م²)</label>
                                    <input type="text" name="area" class="form-control" id="area" value="{{ $property->area }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نوع العقار</label>
                                    <select class="form-control" name="property_type">
                                        <option value="">-- اختر --</option>
                                        <option value="أرض زراعية" {{ $property->property_type == 'أرض زراعية' ? 'selected' : '' }}>أرض زراعية</option>
                                        <option value="حوش" {{ $property->property_type == 'حوش' ? 'selected' : '' }}>حوش</option>
                                        <option value="بيت شعبي" {{ $property->property_type == 'بيت شعبي' ? 'selected' : '' }}>بيت شعبي</option>
                                        <option value="فيلا" {{ $property->property_type == 'فيلا' ? 'selected' : '' }}>فيلا</option>
                                        <option value="شقة" {{ $property->property_type == 'شقة' ? 'selected' : '' }}>شقة</option>
                                        <option value="مبنى تجاري" {{ $property->property_type == 'مبنى تجاري' ? 'selected' : '' }}>مبنى تجاري</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>تصنيف العقار</label>
                                    <select class="form-control" name="propery_cat">
                                        <option value="">-- اختر --</option>
                                        <option value="بيع اراضى" {{ $property->propery_cat == 'بيع اراضى' ? 'selected' : '' }}>بيع أراضى</option>
                                        <option value="بيع منازل" {{ $property->propery_cat == 'بيع منازل' ? 'selected' : '' }}>بيع منازل</option>
                                        <option value="تأجير أراضى" {{ $property->propery_cat == 'تأجير أراضى' ? 'selected' : '' }}>تأجير أراضى</option>
                                        <option value="تأجير منازل" {{ $property->propery_cat == 'تأجير منازل' ? 'selected' : '' }}>تأجير منازل</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>حالة تملك الأرض</label>
                                    <select class="form-control" name="land_situation">
                                        <option value="">-- اختر --</option>
                                        <option value="أرض بصك" {{ $property->land_situation == 'أرض بصك' ? 'selected' : '' }}>أرض بصك</option>
                                        <option value="أرض باحكام" {{ $property->land_situation == 'أرض باحكام' ? 'selected' : '' }}>أرض باحكام</option>
                                        <option value="أرض استثمار" {{ $property->land_situation == 'أرض استثمار' ? 'selected' : '' }}>أرض استثمار</option>
                                        <option value="أرض بدون" {{ $property->land_situation == 'أرض بدون' ? 'selected' : '' }}>أرض بدون</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">السعر (ريال) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="price" class="form-control" id="price" value="{{ $property->price }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">ريال</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>حالة العقار</label>
                                    <select class="form-control" name="status">
                                        <option value="Available" {{ $property->status == 'Available' ? 'selected' : '' }}>متاح</option>
                                        <option value="Reserved" {{ $property->status == 'Reserved' ? 'selected' : '' }}>محجوز</option>
                                        <option value="Sold" {{ $property->status == 'Sold' ? 'selected' : '' }}>مباع</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">وصف العقار</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="اكتب وصفاً تفصيلياً للعقار...">{{ $property->description }}</textarea>
                        </div>

                        <div class="form-group mb-0">
                            <label for="notes">ملاحظات</label>
                            <textarea class="form-control" name="notes" id="notes" rows="2" placeholder="ملاحظات إضافية...">{{ $property->notes }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Location Card -->
                <div class="card mt-4">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-map-marker-alt text-danger ml-2"></i>
                            الموقع
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="location">عنوان الموقع</label>
                            <div class="input-group">
                                <input type="text" name="location" class="form-control" id="location" value="{{ $property->location }}" placeholder="مثال: حي النخيل، الرياض">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" onclick="searchLocation()">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <small class="text-muted">اكتب العنوان واضغط بحث أو انقر على الخريطة مباشرة لتحديد الموقع</small>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label for="latitude">خط العرض (Latitude)</label>
                                    <input type="text" name="latitude" class="form-control" id="latitude" value="{{ $property->latitude ?? '24.7136' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label for="longitude">خط الطول (Longitude)</label>
                                    <input type="text" name="longitude" class="form-control" id="longitude" value="{{ $property->longitude ?? '46.6753' }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div id="map" style="height: 350px; width: 100%; border-radius: 10px; border: 2px solid #e9ecef;"></div>
                        <div class="mt-2 d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="fas fa-info-circle ml-1"></i> انقر على الخريطة لتحديد موقع العقار أو اسحب العلامة</small>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="getCurrentLocation()">
                                <i class="fas fa-crosshairs ml-1"></i> موقعي الحالي
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Images Card -->
                <div class="card mt-4">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-images text-info ml-2"></i>
                            صور العقار
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Current Images -->
                        @if($multiImages && count($multiImages) > 0)
                        <label class="mb-2">الصور الحالية</label>
                        <div class="current-images d-flex flex-wrap mb-3" style="gap: 10px;">
                            @foreach($multiImages as $image)
                            <div class="position-relative" style="width: 120px;">
                                <img src="{{ asset('upload/property/multi_img/' . $image->images) }}"
                                     class="img-thumbnail" style="width: 120px; height: 90px; object-fit: cover;"
                                     onerror="this.src='{{ asset('placholder.png') }}'">
                                <button type="button" class="btn btn-danger btn-sm position-absolute"
                                        style="top: -8px; right: -8px; width: 24px; height: 24px; padding: 0; border-radius: 50%;"
                                        onclick="deleteExistingImage({{ $image->id }}, this)">
                                    <i class="fas fa-times" style="font-size: 12px;"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <hr>
                        @endif

                        <!-- Upload New Images -->
                        <label>إضافة صور جديدة</label>
                        <div class="upload-area p-4 text-center" style="border: 2px dashed #dee2e6; border-radius: 10px; cursor: pointer; transition: all 0.3s;"
                             onclick="document.getElementById('multiImg').click()"
                             ondragover="this.style.borderColor='#0F302E'; this.style.background='#f8f9fa';"
                             ondragleave="this.style.borderColor='#dee2e6'; this.style.background='transparent';">
                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                            <p class="mb-1">اسحب الصور هنا أو انقر للاختيار</p>
                            <small class="text-muted">يمكنك اختيار عدة صور (PNG, JPG, GIF)</small>
                        </div>
                        <input type="file" name="multi_img[]" class="d-none" multiple id="multiImg" accept="image/*" onchange="previewMultiImages(this)">

                        <div id="multiPreview" class="d-flex flex-wrap mt-3" style="gap: 10px;"></div>
                    </div>
                </div>
            </div>

            <!-- Left Column - Owner & Contacts -->
            <div class="col-lg-4">
                <!-- Owner Card -->
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-user text-success ml-2"></i>
                            معلومات المالك
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="owner">اسم المالك</label>
                            <input type="text" name="owner" class="form-control" id="owner" value="{{ $property->owner }}">
                        </div>
                        <div class="form-group">
                            <label for="ophone">رقم الهاتف</label>
                            <input type="text" name="ophone" class="form-control" id="ophone" value="{{ $property->ophone }}" dir="ltr">
                        </div>
                        <div class="form-group mb-0">
                            <label>صفة المالك</label>
                            <select class="form-control" name="owner_status">
                                <option value="مالك" {{ $property->owner_status == 'مالك' ? 'selected' : '' }}>مالك</option>
                                <option value="وكيل" {{ $property->owner_status == 'وكيل' ? 'selected' : '' }}>وكيل</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Mediators Card -->
                <div class="card mt-4">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-users text-warning ml-2"></i>
                            الوسطاء
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mediator-box p-3 mb-3" style="background: #f8f9fa; border-radius: 10px;">
                            <label class="text-primary mb-2"><i class="fas fa-user-tie ml-1"></i> الوسيط الأول</label>
                            <div class="form-group mb-2">
                                <input type="text" name="mediator1" class="form-control" placeholder="الاسم" value="{{ $property->mediator1 }}">
                            </div>
                            <div class="form-group mb-0">
                                <input type="text" name="phone1" class="form-control" placeholder="رقم الهاتف" value="{{ $property->phone1 }}" dir="ltr">
                            </div>
                        </div>

                        <div class="mediator-box p-3" style="background: #f8f9fa; border-radius: 10px;">
                            <label class="text-success mb-2"><i class="fas fa-user-tie ml-1"></i> الوسيط الثاني</label>
                            <div class="form-group mb-2">
                                <input type="text" name="mediator2" class="form-control" placeholder="الاسم" value="{{ $property->mediator2 }}">
                            </div>
                            <div class="form-group mb-0">
                                <input type="text" name="phone2" class="form-control" placeholder="رقم الهاتف" value="{{ $property->phone2 }}" dir="ltr">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Card -->
                <div class="card mt-4 border-0" style="background: linear-gradient(135deg, #0F302E 0%, #1a5c3a 100%);">
                    <div class="card-body">
                        <button type="submit" class="btn btn-light btn-lg btn-block">
                            <i class="fas fa-save ml-2"></i> حفظ التعديلات
                        </button>
                        <a href="{{ route('property.show', $property->id) }}" class="btn btn-outline-light btn-block mt-2">
                            <i class="fas fa-times ml-2"></i> إلغاء
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Delete Image Form (Hidden) -->
<form id="deleteImageForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('styles')
<style>
    .upload-area:hover {
        border-color: #0F302E !important;
        background: #f8f9fa;
    }
    .preview-item {
        position: relative;
        width: 120px;
    }
    .preview-item img {
        width: 120px;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
    }
    .preview-item .remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #dc3545;
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }
</style>
@endpush

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=places" async defer></script>

<script>
    var map, marker, geocoder;
    var defaultLat = {{ $property->latitude ?? 24.7136 }};
    var defaultLng = {{ $property->longitude ?? 46.6753 }};

    function initMap() {
        geocoder = new google.maps.Geocoder();

        var mapOptions = {
            center: { lat: defaultLat, lng: defaultLng },
            zoom: 15,
            mapTypeControl: true,
            streetViewControl: false,
            fullscreenControl: true
        };

        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // Create draggable marker
        marker = new google.maps.Marker({
            position: { lat: defaultLat, lng: defaultLng },
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            title: 'اسحب لتحديد الموقع'
        });

        // Update coordinates when marker is dragged
        marker.addListener('dragend', function(event) {
            updateCoordinates(event.latLng.lat(), event.latLng.lng());
            reverseGeocode(event.latLng);
        });

        // Update marker position when map is clicked
        map.addListener('click', function(event) {
            marker.setPosition(event.latLng);
            updateCoordinates(event.latLng.lat(), event.latLng.lng());
            reverseGeocode(event.latLng);
        });
    }

    function updateCoordinates(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(6);
        document.getElementById('longitude').value = lng.toFixed(6);
    }

    function reverseGeocode(latLng) {
        geocoder.geocode({ location: latLng }, function(results, status) {
            if (status === 'OK' && results[0]) {
                document.getElementById('location').value = results[0].formatted_address;
            }
        });
    }

    function searchLocation() {
        var address = document.getElementById('location').value;
        if (!address) {
            alert('الرجاء إدخال عنوان للبحث');
            return;
        }

        geocoder.geocode({ address: address }, function(results, status) {
            if (status === 'OK') {
                var location = results[0].geometry.location;
                map.setCenter(location);
                map.setZoom(17);
                marker.setPosition(location);
                updateCoordinates(location.lat(), location.lng());
                document.getElementById('location').value = results[0].formatted_address;
            } else {
                alert('لم يتم العثور على الموقع: ' + status);
            }
        });
    }

    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                var latLng = new google.maps.LatLng(lat, lng);

                map.setCenter(latLng);
                map.setZoom(17);
                marker.setPosition(latLng);
                updateCoordinates(lat, lng);
                reverseGeocode(latLng);
            }, function(error) {
                alert('لم نتمكن من الحصول على موقعك الحالي');
            });
        } else {
            alert('المتصفح لا يدعم تحديد الموقع');
        }
    }

    // Allow Enter key to search
    document.getElementById('location').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchLocation();
        }
    });

    // Image preview
    function previewMultiImages(input) {
        var multiPreview = document.getElementById('multiPreview');
        multiPreview.innerHTML = '';

        if (input.files && input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                (function(file, index) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var div = document.createElement('div');
                        div.className = 'preview-item';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview">
                            <button type="button" class="remove-btn" onclick="removePreview(this, ${index})">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                        multiPreview.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                })(input.files[i], i);
            }
        }
    }

    function removePreview(btn, index) {
        btn.parentElement.remove();
    }

    function deleteExistingImage(imageId, btn) {
        if (confirm('هل أنت متأكد من حذف هذه الصورة؟')) {
            fetch('/property/image/' + imageId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    btn.parentElement.remove();
                } else {
                    alert('حدث خطأ أثناء حذف الصورة');
                }
            })
            .catch(error => {
                // If route doesn't exist, just remove from DOM
                btn.parentElement.remove();
            });
        }
    }
</script>
@endpush
