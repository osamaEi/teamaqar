<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->name }} - أبو نواف للعقارات</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #0F302E;
            --primary-teal: #1B8A8A;
            --accent-gold: #C4A962;
            --light-bg: #f8f9fa;
            --text-gray: #6c757d;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Cairo', sans-serif; background: var(--light-bg); color: #212529; overflow-x: hidden; }

        /* ── Navbar ── */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 14px 5%;
            display: flex; justify-content: space-between; align-items: center;
            background: rgba(15,48,46,.97);
            box-shadow: 0 3px 20px rgba(0,0,0,.25);
            transition: padding .3s;
        }
        .navbar.compact { padding: 10px 5%; }
        .logo img { height: 52px; width: auto; }
        .nav-links { display: flex; align-items: center; gap: 22px; }
        .nav-links a { color: rgba(255,255,255,.85); text-decoration: none; font-weight: 600; font-size: 14px; transition: color .2s; }
        .nav-links a:hover { color: var(--accent-gold); }
        .login-btn {
            background: linear-gradient(135deg, var(--primary-teal), #147a7a);
            color: white !important; padding: 9px 22px; border-radius: 50px;
            font-weight: 600; font-size: 14px; transition: opacity .2s;
        }
        .login-btn:hover { opacity: .88; }
        .menu-toggle { display: none; background: none; border: none; color: white; font-size: 24px; cursor: pointer; }
        @media (max-width: 768px) {
            .menu-toggle { display: block; }
            .nav-links { display: none; }
            .nav-links.open { display: flex; flex-direction: column; position: fixed; top: 0; right: 0; bottom: 0; width: 260px; background: var(--primary-dark); padding: 80px 30px 30px; gap: 20px; z-index: 1100; box-shadow: -5px 0 30px rgba(0,0,0,.3); }
        }

        /* ── Page header ── */
        .page-hero {
            margin-top: 80px;
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1a4a47 100%);
            padding: 50px 5% 40px;
            position: relative;
            overflow: hidden;
        }
        .page-hero::before {
            content: '';
            position: absolute; inset: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="g" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M10 0L0 0 0 10" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23g)"/></svg>');
        }
        .page-hero-inner { position: relative; z-index: 1; max-width: 1200px; margin: 0 auto; }
        .breadcrumb-nav { display: flex; align-items: center; gap: 8px; margin-bottom: 16px; }
        .breadcrumb-nav a { color: rgba(255,255,255,.6); text-decoration: none; font-size: 13px; transition: color .2s; }
        .breadcrumb-nav a:hover { color: var(--accent-gold); }
        .breadcrumb-nav span { color: rgba(255,255,255,.3); font-size: 12px; }
        .page-hero h1 { color: white; font-size: 2rem; font-weight: 800; margin-bottom: 14px; line-height: 1.3; }
        .hero-badges { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
        .status-badge {
            padding: 6px 18px; border-radius: 30px; font-size: 13px; font-weight: 700;
        }
        .status-available { background: #22c55e; color: white; }
        .status-sold      { background: #ef4444; color: white; }
        .status-reserved  { background: #f59e0b; color: white; }
        .type-badge {
            background: rgba(255,255,255,.12); color: rgba(255,255,255,.9);
            padding: 6px 16px; border-radius: 30px; font-size: 13px; font-weight: 600;
            border: 1px solid rgba(255,255,255,.15);
        }
        .location-badge {
            display: flex; align-items: center; gap: 6px;
            color: rgba(255,255,255,.7); font-size: 13px;
        }
        .location-badge i { color: var(--accent-gold); }

        /* ── Layout ── */
        .page-body { max-width: 1200px; margin: 0 auto; padding: 40px 5% 60px; }
        .page-grid { display: grid; grid-template-columns: 1fr 360px; gap: 28px; }
        @media (max-width: 992px) { .page-grid { grid-template-columns: 1fr; } }

        /* ── Card ── */
        .card {
            background: white; border-radius: 18px;
            box-shadow: 0 4px 20px rgba(0,0,0,.06); overflow: hidden;
        }
        .card-head {
            padding: 18px 22px; border-bottom: 1px solid #f0f0f0;
            display: flex; align-items: center; gap: 10px;
        }
        .card-head h3 { font-size: 16px; font-weight: 700; color: var(--primary-dark); margin: 0; }
        .card-head i { color: var(--primary-teal); font-size: 16px; }
        .card-body { padding: 22px; }

        /* ── Gallery ── */
        .gallery-main {
            position: relative; height: 440px; overflow: hidden;
            background: #111;
        }
        .gallery-main img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform .4s;
            cursor: zoom-in;
        }
        .gallery-main img:hover { transform: scale(1.02); }
        .gallery-nav {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 44px; height: 44px; border-radius: 50%;
            background: rgba(255,255,255,.9); border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: var(--primary-dark);
            transition: background .2s, transform .2s;
            box-shadow: 0 4px 12px rgba(0,0,0,.2);
        }
        .gallery-nav:hover { background: white; transform: translateY(-50%) scale(1.1); }
        .gallery-prev { right: 16px; }
        .gallery-next { left: 16px; }
        .gallery-counter {
            position: absolute; bottom: 14px; left: 14px;
            background: rgba(0,0,0,.6); color: white;
            padding: 4px 14px; border-radius: 20px; font-size: 13px;
        }
        .gallery-thumbs {
            display: flex; gap: 10px; padding: 14px 16px; overflow-x: auto;
            background: #fafafa; border-top: 1px solid #f0f0f0;
        }
        .gallery-thumbs::-webkit-scrollbar { height: 4px; }
        .gallery-thumbs::-webkit-scrollbar-thumb { background: #ddd; border-radius: 2px; }
        .thumb {
            width: 72px; height: 54px; border-radius: 10px; overflow: hidden;
            border: 3px solid transparent; cursor: pointer; flex-shrink: 0;
            transition: border-color .2s, transform .2s;
        }
        .thumb.active { border-color: var(--primary-dark); }
        .thumb:hover { transform: scale(1.05); }
        .thumb img { width: 100%; height: 100%; object-fit: cover; }

        /* ── Details table ── */
        .detail-table { width: 100%; border-collapse: collapse; }
        .detail-table tr { border-bottom: 1px solid #f5f5f5; }
        .detail-table tr:last-child { border-bottom: none; }
        .detail-table td { padding: 12px 4px; font-size: 14px; }
        .detail-table td:first-child { color: var(--text-gray); width: 42%; }
        .detail-table td:last-child { font-weight: 600; color: var(--primary-dark); }

        /* ── Map ── */
        #propMap { height: 280px; width: 100%; }

        /* ── Info sidebar ── */
        .info-item {
            display: flex; align-items: flex-start; gap: 14px;
            padding: 14px 0; border-bottom: 1px solid #f5f5f5;
        }
        .info-item:last-child { border-bottom: none; }
        .info-icon {
            width: 42px; height: 42px; border-radius: 12px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; font-size: 16px;
        }
        .info-label { font-size: 12px; color: var(--text-gray); margin-bottom: 2px; }
        .info-value { font-size: 15px; font-weight: 700; color: var(--primary-dark); }

        /* ── CTA box ── */
        .cta-box {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1a4a47 100%);
            border-radius: 18px; padding: 28px 24px; text-align: center;
        }
        .cta-box h4 { color: white; font-size: 17px; margin-bottom: 8px; }
        .cta-box p { color: rgba(255,255,255,.7); font-size: 13px; margin-bottom: 20px; line-height: 1.7; }
        .btn-cta {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            width: 100%; padding: 13px; border-radius: 50px; font-weight: 700;
            font-size: 14px; text-decoration: none; transition: opacity .2s, transform .15s;
            margin-bottom: 10px; cursor: pointer; border: none; font-family: 'Cairo', sans-serif;
        }
        .btn-cta:hover { opacity: .88; transform: translateY(-2px); text-decoration: none; }
        .btn-whatsapp { background: #22c55e; color: white; }
        .btn-request  { background: var(--accent-gold); color: var(--primary-dark); }
        .btn-back     { background: rgba(255,255,255,.12); color: white; border: 1px solid rgba(255,255,255,.2); }
        .btn-back:hover { background: rgba(255,255,255,.2); color: white; }

        /* ── Share ── */
        .share-row { display: flex; gap: 10px; justify-content: center; margin-top: 16px; }
        .share-btn {
            width: 40px; height: 40px; border-radius: 50%; display: flex;
            align-items: center; justify-content: center; font-size: 15px;
            text-decoration: none; transition: transform .2s, opacity .2s;
        }
        .share-btn:hover { transform: scale(1.12); opacity: .88; }

        /* ── Description ── */
        .description-text { font-size: 15px; line-height: 2; color: #444; }

        /* ── Lightbox ── */
        .lightbox {
            display: none; position: fixed; inset: 0; z-index: 9999;
            background: rgba(0,0,0,.92); align-items: center; justify-content: center;
        }
        .lightbox.open { display: flex; }
        .lightbox img { max-width: 90vw; max-height: 88vh; border-radius: 10px; object-fit: contain; }
        .lightbox-close {
            position: absolute; top: 20px; left: 24px;
            color: white; font-size: 32px; cursor: pointer; line-height: 1;
        }
        .lightbox-prev { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); color: white; font-size: 36px; cursor: pointer; }
        .lightbox-next { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: white; font-size: 36px; cursor: pointer; }

        /* ── Footer ── */
        .footer { background: var(--primary-dark); padding: 40px 5% 20px; }
        .footer-inner { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 30px; max-width: 1200px; margin: 0 auto 30px; }
        .footer-brand img { height: 64px; margin-bottom: 12px; }
        .footer-brand p { color: rgba(255,255,255,.5); font-size: 13px; line-height: 1.8; max-width: 260px; }
        .footer-col h4 { color: white; font-size: 15px; margin-bottom: 16px; }
        .footer-col a { display: block; color: rgba(255,255,255,.55); text-decoration: none; font-size: 13px; margin-bottom: 8px; transition: color .2s; }
        .footer-col a:hover { color: var(--accent-gold); }
        .footer-col p { color: rgba(255,255,255,.55); font-size: 13px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px; }
        .footer-col p i { color: var(--accent-gold); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.08); padding-top: 20px; text-align: center; color: rgba(255,255,255,.35); font-size: 13px; max-width: 1200px; margin: 0 auto; }

        /* ── Related props ── */
        .related-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; }
        .rel-card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,.07); text-decoration: none; color: inherit; display: block; transition: transform .25s, box-shadow .25s; }
        .rel-card:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(0,0,0,.12); text-decoration: none; color: inherit; }
        .rel-img { height: 150px; overflow: hidden; }
        .rel-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s; }
        .rel-card:hover .rel-img img { transform: scale(1.06); }
        .rel-body { padding: 14px; }
        .rel-name { font-size: 14px; font-weight: 700; color: var(--primary-dark); margin-bottom: 6px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .rel-loc { font-size: 12px; color: var(--text-gray); display: flex; align-items: center; gap: 5px; }
        .rel-loc i { color: var(--primary-teal); }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <a href="/" class="logo">
            <img src="{{ asset('upload/123.png') }}" alt="أبو نواف للعقارات">
        </a>
        <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
        <div class="nav-links" id="navLinks">
            <a href="/">الرئيسية</a>
            <a href="/#properties">العقارات</a>
            <a href="/#contact">تواصل معنا</a>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('dashboard.page') }}" class="login-btn"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="login-btn">لوحتي</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="login-btn">تسجيل الدخول</a>
            @endauth
        </div>
    </nav>

    <!-- Page Hero -->
    <div class="page-hero">
        <div class="page-hero-inner">
            <div class="breadcrumb-nav">
                <a href="/"><i class="fas fa-home"></i> الرئيسية</a>
                <span>/</span>
                <a href="/#properties">العقارات</a>
                <span>/</span>
                <span style="color:rgba(255,255,255,.7)">{{ Str::limit($property->name, 40) }}</span>
            </div>
            <h1>{{ $property->name }}</h1>
            <div class="hero-badges">
                @php
                    $statusClass = match($property->status) { 'Sold' => 'status-sold', 'Reserved' => 'status-reserved', default => 'status-available' };
                    $statusLabel = match($property->status) { 'Sold' => 'مباع', 'Reserved' => 'محجوز', default => 'متاح' };
                @endphp
                <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                @if($property->property_type)
                    <span class="type-badge"><i class="fas fa-home"></i> {{ $property->property_type }}</span>
                @endif
                @if($property->city || $property->location)
                    <span class="location-badge"><i class="fas fa-map-marker-alt"></i> {{ $property->city ?: $property->location }}</span>
                @endif
                @if($property->number)
                    <span class="type-badge"><i class="fas fa-hashtag"></i> {{ $property->number }}</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="page-body">
        <div class="page-grid">

            <!-- ── Left column: gallery + details + map ── -->
            <div style="display:flex;flex-direction:column;gap:24px;">

                <!-- Gallery -->
                <div class="card">
                    @php $images = $multiImage ?? collect(); @endphp
                    @if($images->count() > 0)
                    <div class="gallery-main" id="galleryMain">
                        <img id="mainImg"
                             src="{{ asset('upload/property/multi_img/' . $images[0]->images) }}"
                             alt="{{ $property->name }}"
                             onerror="this.src='{{ asset('placholder.png') }}'"
                             onclick="openLightbox(currentIdx)">
                        @if($images->count() > 1)
                            <button class="gallery-nav gallery-prev" onclick="changeImg(currentIdx - 1)"><i class="fas fa-chevron-right"></i></button>
                            <button class="gallery-nav gallery-next" onclick="changeImg(currentIdx + 1)"><i class="fas fa-chevron-left"></i></button>
                            <div class="gallery-counter"><span id="imgNum">1</span> / {{ $images->count() }}</div>
                        @endif
                    </div>
                    @if($images->count() > 1)
                    <div class="gallery-thumbs" id="thumbsRow">
                        @foreach($images as $idx => $img)
                        <div class="thumb {{ $idx === 0 ? 'active' : '' }}" id="thumb-{{ $idx }}"
                             onclick="changeImg({{ $idx }})">
                            <img src="{{ asset('upload/property/multi_img/' . $img->images) }}"
                                 onerror="this.src='{{ asset('placholder.png') }}'">
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @else
                    <div class="gallery-main">
                        <img src="{{ asset('placholder.png') }}" alt="لا توجد صورة" style="cursor:default;">
                    </div>
                    @endif
                </div>

                <!-- Details -->
                <div class="card">
                    <div class="card-head">
                        <i class="fas fa-info-circle"></i>
                        <h3>تفاصيل العقار</h3>
                    </div>
                    <div class="card-body">
                        <table class="detail-table">
                            @if($property->property_type)
                            <tr><td>نوع العقار</td><td>{{ $property->property_type }}</td></tr>
                            @endif
                            @if($property->area)
                            <tr><td>المساحة</td><td>{{ number_format($property->area) }} م²</td></tr>
                            @endif
                            @if($property->land_situation)
                            <tr><td>حالة الأرض</td><td>{{ $property->land_situation }}</td></tr>
                            @endif
                            @if($property->city)
                            <tr><td>المدينة</td><td>{{ $property->city }}</td></tr>
                            @endif
                            @if($property->address)
                            <tr><td>الحي / المنطقة</td><td>{{ $property->address }}</td></tr>
                            @endif
                            @if($property->location)
                            <tr><td>الموقع</td><td>{{ $property->location }}</td></tr>
                            @endif
                            @if($property->number)
                            <tr><td>رقم العقار</td><td>{{ $property->number }}</td></tr>
                            @endif
                            @if($property->created_at)
                            <tr><td>تاريخ الإضافة</td><td>{{ $property->created_at->format('d/m/Y') }}</td></tr>
                            @endif
                        </table>
                    </div>
                </div>

                <!-- Description -->
                @if($property->description)
                <div class="card">
                    <div class="card-head">
                        <i class="fas fa-align-right"></i>
                        <h3>وصف العقار</h3>
                    </div>
                    <div class="card-body">
                        <p class="description-text">{{ $property->description }}</p>
                    </div>
                </div>
                @endif

                <!-- Map -->
                @if($property->latitude && $property->longitude)
                <div class="card">
                    <div class="card-head">
                        <i class="fas fa-map-marker-alt" style="color:#ef4444;"></i>
                        <h3>موقع العقار على الخريطة</h3>
                    </div>
                    <div id="propMap"></div>
                </div>
                @endif

            </div>

            <!-- ── Right column: sidebar ── -->
            <div style="display:flex;flex-direction:column;gap:20px;">

                <!-- Quick info -->
                <div class="card">
                    <div class="card-body" style="padding:18px 20px;">
                        <div class="info-item">
                            <div class="info-icon" style="background:#e8f5e9;"><i class="fas fa-vector-square" style="color:#22c55e;"></i></div>
                            <div>
                                <div class="info-label">المساحة</div>
                                <div class="info-value">{{ $property->area ? number_format($property->area).' م²' : '—' }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon" style="background:#e3f2fd;"><i class="fas fa-map-marker-alt" style="color:#1976d2;"></i></div>
                            <div>
                                <div class="info-label">الموقع</div>
                                <div class="info-value" style="font-size:13px;">{{ $property->city ?: ($property->location ?: '—') }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon" style="background:#fff3e0;"><i class="fas fa-home" style="color:#f57c00;"></i></div>
                            <div>
                                <div class="info-label">نوع العقار</div>
                                <div class="info-value">{{ $property->property_type ?: '—' }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon" style="background:#f3e5f5;"><i class="fas fa-calendar-alt" style="color:#7b1fa2;"></i></div>
                            <div>
                                <div class="info-label">تاريخ الإضافة</div>
                                <div class="info-value">{{ $property->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="cta-box">
                    <h4>هل يعجبك هذا العقار؟</h4>
                    <p>تواصل معنا الآن للحصول على مزيد من المعلومات أو لتحديد موعد لمعاينته</p>

                    @if($property->ophone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $property->ophone) }}?text={{ urlencode('السلام عليكم، أرغب في الاستفسار عن عقار: '.$property->name.' - '.$property->city) }}"
                       target="_blank" class="btn-cta btn-whatsapp">
                        <i class="fab fa-whatsapp fa-lg"></i> تواصل عبر واتساب
                    </a>
                    <a href="tel:{{ $property->ophone }}" class="btn-cta btn-request">
                        <i class="fas fa-phone"></i> اتصل الآن
                    </a>
                    @else
                    <a href="{{ route('clients.index') }}" class="btn-cta btn-request">
                        <i class="fas fa-paper-plane"></i> أرسل طلبك
                    </a>
                    @endif

                    <a href="/" class="btn-cta btn-back">
                        <i class="fas fa-arrow-right"></i> العودة للرئيسية
                    </a>

                    <!-- Share -->
                    <div class="share-row">
                        <a href="https://wa.me/?text={{ urlencode($property->name . ' - ' . request()->url()) }}"
                           target="_blank" class="share-btn" style="background:#25d366;color:white;" title="واتساب">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($property->name) }}&url={{ urlencode(request()->url()) }}"
                           target="_blank" class="share-btn" style="background:#1da1f2;color:white;" title="تويتر">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <button onclick="copyLink()" class="share-btn" style="background:#6c757d;color:white;border:none;cursor:pointer;" title="نسخ الرابط">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                    <p id="copyMsg" style="color:rgba(255,255,255,.6);font-size:12px;margin-top:8px;display:none;">تم نسخ الرابط ✓</p>
                </div>

                <!-- Admin quick actions (only if logged in as admin) -->
                @auth
                @if(auth()->user()->role === 'admin')
                <div class="card">
                    <div class="card-head">
                        <i class="fas fa-cog"></i>
                        <h3>إجراءات</h3>
                    </div>
                    <div class="card-body" style="display:flex;flex-direction:column;gap:8px;">
                        <a href="{{ route('property.edit', $property->id) }}"
                           style="display:flex;align-items:center;gap:8px;padding:11px 16px;background:#fff8e1;border-radius:12px;color:#f57c00;font-weight:600;font-size:13px;text-decoration:none;transition:opacity .2s;">
                            <i class="fas fa-edit"></i> تعديل العقار
                        </a>
                        <a href="{{ route('property.show', $property->id) }}"
                           style="display:flex;align-items:center;gap:8px;padding:11px 16px;background:#e3f2fd;border-radius:12px;color:#1976d2;font-weight:600;font-size:13px;text-decoration:none;transition:opacity .2s;">
                            <i class="fas fa-cogs"></i> عرض لوحة التحكم
                        </a>
                    </div>
                </div>
                @endif
                @endauth

            </div>
        </div>

        <!-- Related Properties -->
        @if($relatedProperties->count() > 0)
        <div style="margin-top:40px;">
            <h2 style="font-size:1.4rem;font-weight:800;color:var(--primary-dark);margin-bottom:20px;">
                <i class="fas fa-th-large" style="color:var(--primary-teal);margin-left:8px;"></i>
                عقارات مشابهة
            </h2>
            <div class="related-grid">
                @foreach($relatedProperties as $rel)
                @php $relImg = $rel->multiImages->first(); @endphp
                <a href="{{ route('property.public.show', $rel->id) }}" class="rel-card">
                    <div class="rel-img">
                        <img src="{{ $relImg ? asset('upload/property/multi_img/'.$relImg->images) : asset('placholder.png') }}"
                             onerror="this.src='{{ asset('placholder.png') }}'">
                    </div>
                    <div class="rel-body">
                        <div class="rel-name">{{ $rel->name }}</div>
                        @if($rel->city || $rel->location)
                        <div class="rel-loc"><i class="fas fa-map-marker-alt"></i> {{ $rel->city ?: $rel->location }}</div>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <img src="{{ asset('upload/123.png') }}" alt="أبو نواف للعقارات">
                <p>نظام متكامل لإدارة العقارات يوفر لك كل الأدوات اللازمة لإدارة ممتلكاتك بكفاءة</p>
            </div>
            <div class="footer-col">
                <h4>روابط سريعة</h4>
                <a href="/">الرئيسية</a>
                <a href="/#properties">العقارات</a>
                <a href="/#contact">تواصل معنا</a>
            </div>
            <div class="footer-col">
                <h4>تواصل معنا</h4>
                <p><i class="fas fa-envelope"></i> info@abunawaf.com</p>
                <p><i class="fas fa-phone"></i> +966 50 000 0000</p>
                <p><i class="fas fa-map-marker-alt"></i> الرياض، المملكة العربية السعودية</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} أبو نواف للعقارات. جميع الحقوق محفوظة.</p>
        </div>
    </footer>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox" onclick="closeLightboxOutside(event)">
        <span class="lightbox-close" onclick="closeLightbox()">×</span>
        <span class="lightbox-prev" onclick="lbNav(-1)"><i class="fas fa-chevron-right"></i></span>
        <img id="lbImg" src="" alt="">
        <span class="lightbox-next" onclick="lbNav(1)"><i class="fas fa-chevron-left"></i></span>
    </div>

    @if($property->latitude && $property->longitude)
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
    @endif

    <script>
        // ── Navbar scroll ──
        window.addEventListener('scroll', function() {
            document.getElementById('navbar').classList.toggle('compact', window.scrollY > 50);
        });

        // ── Mobile menu ──
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('navLinks').classList.toggle('open');
        });

        // ── Gallery ──
        var allImages = @json($multiImage ? $multiImage->pluck('images')->toArray() : []);
        var baseUrl   = "{{ asset('upload/property/multi_img/') }}/";
        var currentIdx = 0;

        function changeImg(idx) {
            if (allImages.length === 0) return;
            currentIdx = (idx + allImages.length) % allImages.length;
            var src = baseUrl + allImages[currentIdx];
            document.getElementById('mainImg').src = src;
            var numEl = document.getElementById('imgNum');
            if (numEl) numEl.textContent = currentIdx + 1;
            document.querySelectorAll('.thumb').forEach(function(t, i) {
                t.classList.toggle('active', i === currentIdx);
            });
        }

        // ── Lightbox ──
        function openLightbox(idx) {
            if (allImages.length === 0) return;
            currentIdx = idx;
            document.getElementById('lbImg').src = baseUrl + allImages[idx];
            document.getElementById('lightbox').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('open');
            document.body.style.overflow = '';
        }
        function closeLightboxOutside(e) { if (e.target === document.getElementById('lightbox')) closeLightbox(); }
        function lbNav(dir) {
            currentIdx = (currentIdx + dir + allImages.length) % allImages.length;
            document.getElementById('lbImg').src = baseUrl + allImages[currentIdx];
        }

        // ── Keyboard ──
        document.addEventListener('keydown', function(e) {
            if (document.getElementById('lightbox').classList.contains('open')) {
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowRight') lbNav(-1);
                if (e.key === 'ArrowLeft')  lbNav(1);
            } else {
                if (e.key === 'ArrowRight') changeImg(currentIdx - 1);
                if (e.key === 'ArrowLeft')  changeImg(currentIdx + 1);
            }
        });

        // ── Copy link ──
        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(function() {
                var msg = document.getElementById('copyMsg');
                msg.style.display = 'block';
                setTimeout(function() { msg.style.display = 'none'; }, 2500);
            });
        }

        // ── Map ──
        function initMap() {
            var lat = {{ $property->latitude ?? 24.7136 }};
            var lng = {{ $property->longitude ?? 46.6753 }};
            var map = new google.maps.Map(document.getElementById('propMap'), {
                center: { lat: lat, lng: lng }, zoom: 15,
                mapTypeControl: false, streetViewControl: false,
                styles: [{ featureType: 'poi', elementType: 'labels', stylers: [{ visibility: 'off' }] }]
            });
            new google.maps.Marker({
                position: { lat: lat, lng: lng }, map: map,
                title: '{{ addslashes($property->name) }}',
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 12, fillColor: '#0F302E', fillOpacity: 1,
                    strokeWeight: 3, strokeColor: '#ffffff'
                }
            });
        }
    </script>
</body>
</html>
