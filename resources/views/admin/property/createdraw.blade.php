@extends('admin.index')
@section('admin')

<style>
    :root {
        --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .property-form-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .form-header {
        background: var(--gradient-1);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .form-header h2 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .form-section {
        background: white;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 3px solid var(--gradient-1);
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    .form-control, .form-control-select {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-control-select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    #map {
        height: 500px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .image-preview-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .image-preview-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .image-preview-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .image-preview-item img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .image-delete-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: var(--gradient-2);
        color: white;
        border: none;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        font-size: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .image-delete-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(245, 87, 108, 0.3);
    }

    .file-upload-area {
        border: 2px dashed #667eea;
        border-radius: 10px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(102, 126, 234, 0.05);
    }

    .file-upload-area:hover {
        border-color: #764ba2;
        background: rgba(102, 126, 234, 0.1);
    }

    .file-upload-area i {
        font-size: 48px;
        color: #667eea;
        display: block;
        margin-bottom: 10px;
    }

    .file-upload-area p {
        margin: 0;
        color: #667eea;
        font-weight: 600;
    }

    .submit-btn {
        background: var(--gradient-1);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        max-width: 300px;
        display: block;
        margin: 30px auto 0;
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .select2-container .select2-selection--single {
        border: 2px solid #e0e0e0 !important;
        border-radius: 8px !important;
        padding: 6px !important;
        height: auto !important;
    }

    .select2-container .select2-selection--single:focus {
        border-color: #667eea !important;
    }

    @media (max-width: 768px) {
        .form-section {
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .image-preview-container {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }
    }
</style>

<div class="property-form-container">
    <!-- Header -->
    <div class="form-header">
        <h2>📍 إنشاء عرض عقاري جديد</h2>
    </div>

    <form action="{{ route('property.store.draw') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- Basic Information -->
        <div class="form-section">
            <div class="section-title">📋 معلومات الملكية</div>

            <div class="form-row">
                <div class="form-group">
                    <label>اسم الملكية</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>رقم الملكية</label>
                    <input type="number" name="number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>المساحة</label>
                    <input type="text" name="area" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>نوع الملكية</label>
                    <select class="form-control-select select2" name="property_type" required>
                        <option value="">اختر نوع الملكية</option>
                        <option value="أرض زراعية">أرض زراعية</option>
                        <option value="حوش">حوش</option>
                        <option value="بيت شعبي">بيت شعبي</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>حالة تملك الأرض</label>
                    <select class="form-control-select select2" name="land_situation" required>
                        <option value="">اختر حالة التملك</option>
                        <option value="أرض بصك">أرض بصك</option>
                        <option value="أرض باحكام">أرض باحكام</option>
                        <option value="أرض استثمار">أرض استثمار</option>
                        <option value="أرض بدون">أرض بدون</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>الوصف</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label>ملاحظات</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>
        </div>

        <!-- Owner Information -->
        <div class="form-section">
            <div class="section-title">👤 معلومات المالك</div>

            <div class="form-row">
                <div class="form-group">
                    <label>اسم المالك</label>
                    <input type="text" name="owner" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>هاتف المالك</label>
                    <input type="text" name="ophone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>حالة المالك</label>
                    <select class="form-control-select select2" name="owner_status" required>
                        <option value="مالك">مالك</option>
                        <option value="وكيل">وكيل</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Mediators -->
        <div class="form-section">
            <div class="section-title">🤝 المفاوضون</div>

            <div class="form-row">
                <div class="form-group">
                    <label>المفاوض الأول</label>
                    <input type="text" name="mediator1" class="form-control">
                </div>
                <div class="form-group">
                    <label>هاتف المفاوض الأول</label>
                    <input type="text" name="phone1" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>المفاوض الثاني</label>
                    <input type="text" name="mediator2" class="form-control">
                </div>
                <div class="form-group">
                    <label>هاتف المفاوض الثاني</label>
                    <input type="text" name="phone2" class="form-control">
                </div>
            </div>
        </div>

        <!-- Property Details -->
        <div class="form-section">
            <div class="section-title">💼 تفاصيل الملكية</div>

            <div class="form-row">
                <div class="form-group">
                    <label>فئة الملكية</label>
                    <select class="form-control-select select2" name="propery_cat" required>
                        <option value="">اختر الفئة</option>
                        <option value="أرض للبيع">أرض للبيع</option>
                        <option value="منازل للبيع">منازل للبيع</option>
                        <option value="استثمار للتقبيل">استثمار للتقبيل</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>حالة الملكية</label>
                    <select class="form-control-select select2" name="status" required>
                        <option value="">اختر الحالة</option>
                        <option value="Available">متاحة</option>
                        <option value="Reserved">محجوزة</option>
                        <option value="Sold">مباعة</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>السعر</label>
                    <input type="number" name="price" class="form-control" required>
                </div>
            </div>
        </div>

        <!-- Location -->
        <div class="form-section">
            <div class="section-title">📍 الموقع على الخريطة</div>

            <div class="form-group">
                <label>العنوان</label>
                <input type="text" name="location" class="form-control" id="pac-input" required>
            </div>

            <div id="map"></div>

            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <input type="hidden" name="drawn_data" id="drawn_data">
        </div>

        <!-- Images -->
        <div class="form-section">
            <div class="section-title">📸 الصور</div>

            <div class="file-upload-area" id="uploadArea">
                <i class='bx bx-image-add'></i>
                <p>اسحب الصور هنا أو انقر لاختيارها</p>
                <small style="color: #999;">يمكنك تحميل عدة صور</small>
            </div>

            <input type="file" name="multi_img[]" id="multiImg" class="form-control d-none" multiple accept="image/jpeg, image/jpg, image/gif, image/png">

            <div id="multiPreview" class="image-preview-container"></div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="submit-btn">
            <i class='bx bx-plus me-2'></i> إضافة العرض
        </button>
    </form>
</div>

<script>
    // Image upload area drag and drop
    const uploadArea = document.getElementById('uploadArea');
    const multiImg = document.getElementById('multiImg');

    uploadArea.addEventListener('click', () => multiImg.click());

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.style.backgroundColor = 'rgba(102, 126, 234, 0.15)';
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.style.backgroundColor = 'transparent';
        });
    });

    uploadArea.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        multiImg.files = files;
        previewMultiImages(multiImg);
    });

    multiImg.addEventListener('change', function() {
        previewMultiImages(this);
    });

    function previewMultiImages(input) {
        var multiPreview = document.getElementById('multiPreview');
        multiPreview.innerHTML = '';
        if (input.files && input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var container = document.createElement('div');
                    container.className = 'image-preview-item';

                    var img = document.createElement('img');
                    img.src = e.target.result;
                    container.appendChild(img);

                    var deleteButton = document.createElement('button');
                    deleteButton.type = 'button';
                    deleteButton.className = 'image-delete-btn';
                    deleteButton.innerHTML = '&times;';
                    deleteButton.onclick = function(e) {
                        e.preventDefault();
                        container.remove();
                    };
                    container.appendChild(deleteButton);

                    multiPreview.appendChild(container);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 24.740691, lng: 46.6528521 },
            zoom: 13,
            mapTypeId: 'roadmap'
        });

        var drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: ['polygon']
            }
        });
        drawingManager.setMap(map);

        var drawnPolygons = [];

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
            if (event.type == google.maps.drawing.OverlayType.POLYGON) {
                var polygon = event.overlay;
                var path = polygon.getPath();

                var coordinates = [];
                for (var i = 0; i < path.getLength(); i++) {
                    var latLng = path.getAt(i);
                    coordinates.push({
                        lat: latLng.lat(),
                        lng: latLng.lng()
                    });
                }

                drawnPolygons = [{
                    type: 'polygon',
                    coordinates: coordinates
                }];

                document.getElementById('drawn_data').value = JSON.stringify(drawnPolygons);
            }
        });
    }

    // Load Google Maps Script
    var script = document.createElement('script');
    script.src = "https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places,drawing&callback=initAutocomplete&language=ar&region=EG";
    script.async = true;
    script.defer = true;
    document.body.appendChild(script);

    // Initialize Select2
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            dir: 'rtl',
            language: 'ar'
        });
    });
</script>

@endsection
