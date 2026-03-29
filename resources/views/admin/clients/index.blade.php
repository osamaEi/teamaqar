<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>العقارات المتاحة - أبو نواف للعقارات</title>
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
        body { font-family: 'Cairo', sans-serif; background: var(--light-bg); overflow-x: hidden; }

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
        .logo img { height: 52px; }
        .nav-links { display: flex; align-items: center; gap: 22px; }
        .nav-links a { color: rgba(255,255,255,.85); text-decoration: none; font-weight: 600; font-size: 14px; transition: color .2s; }
        .nav-links a:hover { color: var(--accent-gold); }
        .login-btn {
            background: linear-gradient(135deg, var(--primary-teal), #147a7a);
            color: white !important; padding: 9px 22px; border-radius: 50px;
            font-weight: 600 !important; font-size: 14px !important; transition: opacity .2s;
        }
        .login-btn:hover { opacity: .88; }
        .menu-toggle { display: none; background: none; border: none; color: white; font-size: 24px; cursor: pointer; }
        @media (max-width: 768px) {
            .menu-toggle { display: block; }
            .nav-links { display: none; }
            .nav-links.open { display: flex; flex-direction: column; position: fixed; top: 0; right: 0; bottom: 0; width: 260px; background: var(--primary-dark); padding: 80px 30px 30px; gap: 20px; z-index: 1100; box-shadow: -5px 0 30px rgba(0,0,0,.3); }
        }

        /* ── Page Hero ── */
        .page-hero {
            margin-top: 80px;
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1a4a47 100%);
            padding: 60px 5% 50px;
            text-align: center;
            position: relative; overflow: hidden;
        }
        .page-hero::before {
            content: ''; position: absolute; inset: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="g" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M10 0L0 0 0 10" fill="none" stroke="rgba(255,255,255,0.04)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23g)"/></svg>');
        }
        .page-hero-inner { position: relative; z-index: 1; max-width: 700px; margin: 0 auto; }
        .hero-tag { display: inline-block; background: rgba(196,169,98,.15); border: 1px solid var(--accent-gold); color: var(--accent-gold); padding: 6px 20px; border-radius: 30px; font-size: 13px; font-weight: 700; margin-bottom: 20px; }
        .page-hero h1 { color: white; font-size: 2.4rem; font-weight: 800; margin-bottom: 14px; line-height: 1.3; }
        .page-hero p { color: rgba(255,255,255,.7); font-size: 1rem; line-height: 1.8; margin-bottom: 28px; }
        .hero-scroll-btn {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--accent-gold); color: var(--primary-dark);
            padding: 13px 32px; border-radius: 50px; font-weight: 700; font-size: 15px;
            text-decoration: none; transition: opacity .2s, transform .2s;
        }
        .hero-scroll-btn:hover { opacity: .88; transform: translateY(-2px); text-decoration: none; color: var(--primary-dark); }

        /* ── Page body ── */
        .page-body { max-width: 1200px; margin: 0 auto; padding: 60px 5%; }

        /* ── Section heading ── */
        .section-head { margin-bottom: 36px; }
        .section-head h2 { font-size: 1.7rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 6px; }
        .section-head p { color: var(--text-gray); font-size: 14px; }
        .section-line { width: 50px; height: 4px; background: linear-gradient(90deg, var(--primary-dark), var(--primary-teal)); border-radius: 2px; margin-top: 10px; }

        /* ── Properties grid ── */
        .prop-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 24px; margin-bottom: 40px; }

        .prop-card {
            background: white; border-radius: 18px; overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,.07);
            border: 1.5px solid transparent;
            transition: transform .3s, box-shadow .3s, border-color .3s;
            text-decoration: none; color: inherit; display: block;
        }
        .prop-card:hover { transform: translateY(-7px); box-shadow: 0 14px 40px rgba(0,0,0,.12); border-color: var(--primary-teal); text-decoration: none; color: inherit; }

        .prop-img { position: relative; height: 190px; overflow: hidden; }
        .prop-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
        .prop-card:hover .prop-img img { transform: scale(1.06); }

        .prop-status { position: absolute; top: 12px; right: 12px; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; }
        .s-available { background: #22c55e; color: white; }
        .s-sold      { background: #ef4444; color: white; }
        .s-reserved  { background: #f59e0b; color: white; }

        .prop-type { position: absolute; bottom: 12px; left: 12px; background: rgba(15,48,46,.75); backdrop-filter: blur(4px); color: white; padding: 3px 12px; border-radius: 20px; font-size: 11px; }

        .prop-body { padding: 18px; }
        .prop-name { font-size: 15px; font-weight: 700; color: var(--primary-dark); margin-bottom: 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .prop-loc { display: flex; align-items: center; gap: 5px; color: var(--text-gray); font-size: 13px; margin-bottom: 12px; }
        .prop-loc i { color: var(--primary-teal); font-size: 12px; }
        .prop-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 12px; border-top: 1px solid #f0f0f0; }
        .prop-area { font-size: 12px; color: var(--text-gray); display: flex; align-items: center; gap: 5px; }
        .prop-area i { color: var(--primary-teal); }
        .prop-btn { background: var(--primary-dark); color: white; padding: 7px 18px; border-radius: 20px; font-size: 12px; font-weight: 700; text-decoration: none; transition: opacity .2s; }
        .prop-btn:hover { opacity: .82; color: white; text-decoration: none; }

        /* ── Pagination ── */
        .pagi-wrap { display: flex; justify-content: center; margin-bottom: 70px; }
        .pagi-wrap .pagination { display: flex; gap: 6px; list-style: none; }
        .pagi-wrap .page-item .page-link {
            display: flex; align-items: center; justify-content: center;
            width: 38px; height: 38px; border-radius: 10px;
            background: white; color: var(--primary-dark); font-weight: 600; font-size: 14px;
            border: 1.5px solid #e9ecef; text-decoration: none; transition: all .2s;
        }
        .pagi-wrap .page-item.active .page-link,
        .pagi-wrap .page-item .page-link:hover { background: var(--primary-dark); color: white; border-color: var(--primary-dark); }

        /* ── Divider ── */
        .divider { border: none; border-top: 2px solid #e9ecef; margin: 0 0 60px; }

        /* ── Request Form ── */
        .form-section { background: white; border-radius: 24px; overflow: hidden; box-shadow: 0 6px 30px rgba(0,0,0,.08); }

        .form-header {
            background: linear-gradient(135deg, var(--primary-dark), #1a4a47);
            padding: 40px 50px;
        }
        .form-header h2 { color: white; font-size: 1.8rem; font-weight: 800; margin-bottom: 8px; }
        .form-header p { color: rgba(255,255,255,.7); font-size: 14px; line-height: 1.8; }

        .form-body { padding: 40px 50px; }
        @media (max-width: 600px) { .form-header, .form-body { padding: 28px 24px; } }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 650px) { .form-grid { grid-template-columns: 1fr; } }
        .form-full { grid-column: 1 / -1; }

        .form-group { display: flex; flex-direction: column; gap: 7px; }
        .form-group label { font-size: 14px; font-weight: 700; color: var(--primary-dark); }
        .form-group label span { color: #ef4444; margin-right: 2px; }

        .form-control {
            border: 1.5px solid #e9ecef; border-radius: 12px;
            padding: 12px 16px; font-size: 14px; font-family: 'Cairo', sans-serif;
            color: #212529; outline: none; transition: border-color .2s, box-shadow .2s;
            width: 100%; background: #fafafa;
        }
        .form-control:focus { border-color: var(--primary-teal); box-shadow: 0 0 0 3px rgba(27,138,138,.1); background: white; }
        textarea.form-control { resize: vertical; min-height: 110px; }

        .form-select-wrap { position: relative; }
        .form-select-wrap::after { content: '\f107'; font-family: 'Font Awesome 6 Free'; font-weight: 900; position: absolute; left: 16px; top: 50%; transform: translateY(-50%); pointer-events: none; color: var(--text-gray); font-size: 13px; }
        select.form-control { appearance: none; -webkit-appearance: none; cursor: pointer; }

        .submit-btn {
            display: flex; align-items: center; justify-content: center; gap: 10px;
            width: 100%; padding: 15px; border-radius: 50px;
            background: linear-gradient(135deg, var(--primary-dark), #1a4a47);
            color: white; font-family: 'Cairo', sans-serif; font-size: 16px; font-weight: 700;
            border: none; cursor: pointer; transition: opacity .2s, transform .15s;
            margin-top: 8px;
        }
        .submit-btn:hover { opacity: .88; transform: translateY(-2px); }

        .form-note { text-align: center; color: var(--text-gray); font-size: 13px; margin-top: 14px; }
        .form-note i { color: var(--primary-teal); margin-left: 4px; }

        /* ── Footer ── */
        .footer { background: var(--primary-dark); padding: 40px 5% 20px; margin-top: 70px; }
        .footer-inner { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 30px; max-width: 1200px; margin: 0 auto 30px; }
        .footer-brand img { height: 64px; margin-bottom: 12px; }
        .footer-brand p { color: rgba(255,255,255,.5); font-size: 13px; line-height: 1.8; max-width: 260px; }
        .footer-col h4 { color: white; font-size: 15px; margin-bottom: 16px; }
        .footer-col a { display: block; color: rgba(255,255,255,.55); text-decoration: none; font-size: 13px; margin-bottom: 8px; transition: color .2s; }
        .footer-col a:hover { color: var(--accent-gold); }
        .footer-col p { color: rgba(255,255,255,.55); font-size: 13px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px; }
        .footer-col p i { color: var(--accent-gold); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.08); padding-top: 20px; text-align: center; color: rgba(255,255,255,.35); font-size: 13px; max-width: 1200px; margin: 0 auto; }

        /* ── Alerts ── */
        .alert-success-box { background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 12px; padding: 14px 18px; color: #166534; font-size: 14px; font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; gap: 10px; }
        .alert-error-box  { background: #fef2f2; border: 1.5px solid #fca5a5; border-radius: 12px; padding: 14px 18px; color: #991b1b; font-size: 14px; margin-bottom: 24px; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <a href="/" class="logo"><img src="{{ asset('upload/123.png') }}" alt="أبو نواف للعقارات"></a>
        <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
        <div class="nav-links" id="navLinks">
            <a href="/">الرئيسية</a>
            <a href="#properties">العقارات</a>
            <a href="#request-form">أرسل طلبك</a>
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

    <!-- Hero -->
    <div class="page-hero">
        <div class="page-hero-inner">
            <span class="hero-tag"><i class="fas fa-building"></i> عقاراتنا المتاحة</span>
            <h1>ابحث عن عقارك <span style="color:var(--accent-gold);">المثالي</span></h1>
            <p>تصفح مجموعتنا المختارة من أفضل العقارات السكنية والتجارية، أو أرسل طلبك وسنجد لك ما يناسبك</p>
            <a href="#request-form" class="hero-scroll-btn">
                <i class="fas fa-paper-plane"></i> أرسل طلبك الآن
            </a>
        </div>
    </div>

    <!-- Page Body -->
    <div class="page-body">

        <!-- Properties -->
        <section id="properties">
            <div class="section-head">
                <h2><i class="fas fa-building" style="color:var(--primary-teal);margin-left:10px;"></i>العقارات المتاحة</h2>
                <p>{{ $properties->total() }} عقار متاح — تصفح واختر ما يناسبك</p>
                <div class="section-line"></div>
            </div>

            <div class="prop-grid">
                @forelse($properties as $property)
                @php
                    $imgs = $multiImages[$property->id] ?? collect();
                    $imgSrc = $imgs->first() ? asset('upload/property/multi_img/'.$imgs->first()->images) : asset('placholder.png');
                    $sc = match($property->status) { 'Sold' => 's-sold', 'Reserved' => 's-reserved', default => 's-available' };
                    $sl = match($property->status) { 'Sold' => 'مباع', 'Reserved' => 'محجوز', default => 'متاح' };
                @endphp
                <a href="{{ route('property.public.show', $property->id) }}" class="prop-card">
                    <div class="prop-img">
                        <img src="{{ $imgSrc }}" alt="{{ $property->name }}" onerror="this.src='{{ asset('placholder.png') }}'">
                        <span class="prop-status {{ $sc }}">{{ $sl }}</span>
                        @if($property->property_type)
                            <span class="prop-type">{{ $property->property_type }}</span>
                        @endif
                    </div>
                    <div class="prop-body">
                        <div class="prop-name">{{ $property->name }}</div>
                        @if($property->city || $property->location)
                        <div class="prop-loc"><i class="fas fa-map-marker-alt"></i> {{ $property->city ?: $property->location }}</div>
                        @endif
                        <div class="prop-footer">
                            <span class="prop-area">
                                @if($property->area)<i class="fas fa-vector-square"></i> {{ number_format($property->area) }} م²@endif
                            </span>
                            <span class="prop-btn">عرض التفاصيل</span>
                        </div>
                    </div>
                </a>
                @empty
                <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:var(--text-gray);">
                    <i class="fas fa-building" style="font-size:3rem;opacity:.3;display:block;margin-bottom:16px;"></i>
                    <p>لا توجد عقارات متاحة حالياً</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($properties->hasPages())
            <div class="pagi-wrap">
                {{ $properties->links() }}
            </div>
            @endif
        </section>

        <hr class="divider">

        <!-- Request Form -->
        <section id="request-form">
            <div class="section-head">
                <h2><i class="fas fa-paper-plane" style="color:var(--primary-teal);margin-left:10px;"></i>أرسل طلبك</h2>
                <p>أخبرنا بما تبحث عنه وسيتواصل معك فريقنا في أقرب وقت</p>
                <div class="section-line"></div>
            </div>

            <div class="form-section">
                <div class="form-header">
                    <h2>طلب عقار جديد</h2>
                    <p>املأ النموذج أدناه وسنقوم بالتواصل معك لمساعدتك في إيجاد العقار المناسب لاحتياجاتك</p>
                </div>

                <div class="form-body">

                    @if(session('success'))
                    <div class="alert-success-box"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                    <div class="alert-error-box">
                        @foreach($errors->all() as $err)<div><i class="fas fa-exclamation-circle"></i> {{ $err }}</div>@endforeach
                    </div>
                    @endif

                    <form action="{{ route('client.store') }}" method="POST">
                        @csrf
                        <div class="form-grid">

                            <!-- Name -->
                            <div class="form-group">
                                <label>الاسم الكامل <span>*</span></label>
                                <input type="text" name="client_name" class="form-control" placeholder="أدخل اسمك الكامل" value="{{ old('client_name') }}" required>
                            </div>

                            <!-- Phone -->
                            <div class="form-group">
                                <label>رقم الجوال <span>*</span></label>
                                <input type="tel" name="client_phone" class="form-control" placeholder="05xxxxxxxx" value="{{ old('client_phone') }}" required>
                            </div>

                            <!-- Client Type -->
                            <div class="form-group">
                                <label>نوع العميل <span>*</span></label>
                                <div class="form-select-wrap">
                                    <select name="client_type" class="form-control" required>
                                        <option value="" disabled selected>اختر نوع العميل</option>
                                        <option value="عميل"      {{ old('client_type') === 'عميل' ? 'selected' : '' }}>عميل</option>
                                        <option value="وسيط عقاري" {{ old('client_type') === 'وسيط عقاري' ? 'selected' : '' }}>وسيط عقاري</option>
                                        <option value="مالك"       {{ old('client_type') === 'مالك' ? 'selected' : '' }}>مالك</option>
                                        <option value="وكيل"       {{ old('client_type') === 'وكيل' ? 'selected' : '' }}>وكيل</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Request Type -->
                            <div class="form-group">
                                <label>نوع الطلب <span>*</span></label>
                                <div class="form-select-wrap">
                                    <select name="request_name" class="form-control" required>
                                        <option value="" disabled selected>اختر نوع الطلب</option>
                                        <option value="أرض إيجار زراعية"  {{ old('request_name') === 'أرض إيجار زراعية' ? 'selected' : '' }}>أرض إيجار زراعية</option>
                                        <option value="أرض شراء زراعية"   {{ old('request_name') === 'أرض شراء زراعية' ? 'selected' : '' }}>أرض شراء زراعية</option>
                                        <option value="أرض سكنية"          {{ old('request_name') === 'أرض سكنية' ? 'selected' : '' }}>أرض سكنية</option>
                                        <option value="أرض استثمار"        {{ old('request_name') === 'أرض استثمار' ? 'selected' : '' }}>أرض استثمار</option>
                                        <option value="شقة للبيع"          {{ old('request_name') === 'شقة للبيع' ? 'selected' : '' }}>شقة للبيع</option>
                                        <option value="شقة للإيجار"        {{ old('request_name') === 'شقة للإيجار' ? 'selected' : '' }}>شقة للإيجار</option>
                                        <option value="فيلا للبيع"         {{ old('request_name') === 'فيلا للبيع' ? 'selected' : '' }}>فيلا للبيع</option>
                                        <option value="مستودع"             {{ old('request_name') === 'مستودع' ? 'selected' : '' }}>مستودع</option>
                                        <option value="محل تجاري"          {{ old('request_name') === 'محل تجاري' ? 'selected' : '' }}>محل تجاري</option>
                                    </select>
                                </div>
                            </div>

                            <!-- City -->
                            <div class="form-group">
                                <label>المدينة</label>
                                <input type="text" name="city" class="form-control" placeholder="المدينة المطلوبة" value="{{ old('city') }}">
                            </div>

                            <!-- Budget (optional) -->
                            <div class="form-group">
                                <label>الميزانية التقريبية (ريال)</label>
                                <input type="text" name="budget" class="form-control" placeholder="مثال: 500,000" value="{{ old('budget') }}">
                            </div>

                            <!-- Notes -->
                            <div class="form-group form-full">
                                <label>مواصفات إضافية</label>
                                <textarea name="other_request" class="form-control" placeholder="أي تفاصيل إضافية تريد إضافتها...">{{ old('other_request') }}</textarea>
                            </div>

                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            إرسال الطلب
                        </button>
                        <p class="form-note"><i class="fas fa-lock"></i> بياناتك محمية ولن تُشارك مع أي طرف ثالث</p>
                    </form>
                </div>
            </div>
        </section>

    </div><!-- /.page-body -->

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
                <a href="#properties">العقارات</a>
                <a href="#request-form">أرسل طلبك</a>
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

    <script>
        window.addEventListener('scroll', function() {
            document.getElementById('navbar').classList.toggle('compact', window.scrollY > 50);
        });
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('navLinks').classList.toggle('open');
        });
    </script>
</body>
</html>
