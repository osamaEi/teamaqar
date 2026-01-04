<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ app()->getLocale() == 'ar' ? 'أبو نواف للعقارات' : 'Abu Nawaf Real Estate' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-dark: #0F302E;
            --primary-green: #11760E;
            --accent-gold: #F9AB00;
            --white: #ffffff;
            --light-bg: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: {{ app()->getLocale() == 'ar' ? "'Cairo', sans-serif" : "'Poppins', sans-serif" }};
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(15, 48, 46, 0.95);
            padding: 15px 5%;
            box-shadow: 0 5px 30px rgba(0,0,0,0.2);
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo img {
            height: 60px;
            width: auto;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--accent-gold);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-gold);
            transition: width 0.3s;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .lang-switcher {
            display: flex;
            gap: 10px;
        }

        .lang-btn {
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }

        .lang-btn.active {
            background: var(--accent-gold);
            color: var(--primary-dark);
        }

        .lang-btn:not(.active) {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .login-btn {
            background: linear-gradient(135deg, var(--primary-green), #1a8a12);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(17, 118, 14, 0.4);
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(17, 118, 14, 0.5);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1a4a47 50%, var(--primary-dark) 100%);
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.5;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 0 5%;
            max-width: 700px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(249, 171, 0, 0.15);
            border: 1px solid var(--accent-gold);
            color: var(--accent-gold);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .hero h1 {
            color: white;
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 25px;
        }

        .hero h1 span {
            background: linear-gradient(135deg, var(--accent-gold), #ffc107);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            color: rgba(255,255,255,0.8);
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-green), #1a8a12);
            color: white;
            padding: 16px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(17, 118, 14, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(17, 118, 14, 0.5);
        }

        .btn-outline {
            background: transparent;
            color: white;
            padding: 16px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 2px solid rgba(255,255,255,0.3);
            transition: all 0.3s;
        }

        .btn-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
        }

        /* Hero Image */
        .hero-image {
            position: absolute;
            {{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 55%;
            height: 80%;
            z-index: 1;
        }

        .hero-card {
            position: absolute;
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: float 6s ease-in-out infinite;
        }

        .hero-card-1 {
            top: 10%;
            {{ app()->getLocale() == 'ar' ? 'right: 10%' : 'left: 10%' }};
            width: 280px;
        }

        .hero-card-2 {
            bottom: 15%;
            {{ app()->getLocale() == 'ar' ? 'left: 5%' : 'right: 5%' }};
            width: 250px;
            animation-delay: -3s;
        }

        .hero-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .hero-card h4 {
            color: var(--primary-dark);
            font-size: 16px;
            margin-bottom: 8px;
        }

        .hero-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .hero-card .price {
            color: var(--primary-green);
            font-size: 20px;
            font-weight: 700;
        }

        .hero-card .status {
            position: absolute;
            top: 40px;
            {{ app()->getLocale() == 'ar' ? 'left: 40px' : 'right: 40px' }};
            background: var(--primary-green);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* Stats Section */
        .stats {
            background: white;
            padding: 80px 5%;
            display: flex;
            justify-content: center;
            gap: 80px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 4rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #666;
            font-size: 16px;
            font-weight: 600;
        }

        /* Features Section */
        .features {
            background: var(--light-bg);
            padding: 100px 5%;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-bottom: 15px;
        }

        .section-header p {
            color: #666;
            font-size: 1.1rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            border-color: var(--primary-green);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(17, 118, 14, 0.1), rgba(249, 171, 0, 0.1));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }

        .feature-icon i {
            font-size: 32px;
            background: linear-gradient(135deg, var(--primary-green), var(--accent-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .feature-card h3 {
            color: var(--primary-dark);
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .feature-card p {
            color: #666;
            line-height: 1.7;
        }

        /* CTA Section */
        .cta {
            background: linear-gradient(135deg, var(--primary-dark), #1a4a47);
            padding: 100px 5%;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(249, 171, 0, 0.1) 0%, transparent 50%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .cta h2 {
            color: white;
            font-size: 2.5rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .cta p {
            color: rgba(255,255,255,0.8);
            font-size: 1.1rem;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .cta .btn-primary {
            background: var(--accent-gold);
            color: var(--primary-dark);
            position: relative;
            z-index: 1;
        }

        /* Footer */
        .footer {
            background: var(--primary-dark);
            padding: 60px 5% 30px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-brand {
            max-width: 350px;
        }

        .footer-brand .logo {
            margin-bottom: 20px;
        }

        .footer-brand .logo img {
            height: 80px;
        }

        .footer-brand p {
            color: rgba(255,255,255,0.6);
            line-height: 1.8;
        }

        .footer-links h4 {
            color: white;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--accent-gold);
        }

        .footer-contact p {
            color: rgba(255,255,255,0.6);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-contact i {
            color: var(--accent-gold);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 30px;
            text-align: center;
            color: rgba(255,255,255,0.4);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-image {
                display: none;
            }

            .hero-content {
                max-width: 100%;
                text-align: center;
            }

            .hero-buttons {
                justify-content: center;
            }

            .nav-links {
                display: none;
            }

            .stats {
                gap: 40px;
            }

            .stat-number {
                font-size: 3rem;
            }
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 2rem;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .btn-primary, .btn-outline {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    @php
        $lang = app()->getLocale();
        $isAr = $lang == 'ar';
    @endphp

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <a href="/" class="logo">
            <img src="{{ asset('upload/123.png') }}" alt="{{ $isAr ? 'أبو نواف' : 'Abu Nawaf' }}">
        </a>

        <div class="nav-links">
            <a href="#features">{{ $isAr ? 'المميزات' : 'Features' }}</a>
            <a href="#about">{{ $isAr ? 'من نحن' : 'About' }}</a>
            <a href="#contact">{{ $isAr ? 'تواصل معنا' : 'Contact' }}</a>

            <div class="lang-switcher">
                <a href="{{ url('lang/ar') }}" class="lang-btn {{ $isAr ? 'active' : '' }}">العربية</a>
                <a href="{{ url('lang/en') }}" class="lang-btn {{ !$isAr ? 'active' : '' }}">EN</a>
            </div>

            <a href="{{ route('login') }}" class="login-btn">
                <i class="fas fa-sign-in-alt"></i>
                {{ $isAr ? 'تسجيل الدخول' : 'Login' }}
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content animate__animated animate__fadeInUp">
            <div class="hero-badge">
                <i class="fas fa-star"></i>
                {{ $isAr ? 'نظام إدارة عقارات متكامل' : 'Complete Real Estate Management System' }}
            </div>

            <h1>
                {{ $isAr ? 'إدارة عقاراتك' : 'Manage Your Properties' }}
                <br>
                <span>{{ $isAr ? 'بكل سهولة واحترافية' : 'With Ease & Professionalism' }}</span>
            </h1>

            <p>
                {{ $isAr ? 'نظام متكامل لإدارة العقارات يساعدك على تتبع ممتلكاتك، إدارة الطلبات، وتنظيم المواعيد بكفاءة عالية. كل ما تحتاجه في مكان واحد.' : 'A comprehensive real estate management system that helps you track your properties, manage requests, and organize appointments efficiently. Everything you need in one place.' }}
            </p>

            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn-primary">
                    <i class="fas fa-rocket"></i>
                    {{ $isAr ? 'ابدأ الآن' : 'Get Started' }}
                </a>
                <a href="#features" class="btn-outline">
                    <i class="fas fa-play-circle"></i>
                    {{ $isAr ? 'تعرف على المزيد' : 'Learn More' }}
                </a>
            </div>
        </div>

        <div class="hero-image">
            <div class="hero-card hero-card-1 animate__animated animate__fadeInRight">
                <img src="{{ asset('placholder.png') }}" alt="Property">
                <span class="status">{{ $isAr ? 'متاح' : 'Available' }}</span>
                <h4>{{ $isAr ? 'فيلا فاخرة' : 'Luxury Villa' }}</h4>
                <p><i class="fas fa-map-marker-alt"></i> {{ $isAr ? 'الرياض، حي النخيل' : 'Riyadh, Al Nakhil' }}</p>
                <div class="price">{{ $isAr ? '2,500,000 ريال' : '2,500,000 SAR' }}</div>
            </div>

            <div class="hero-card hero-card-2 animate__animated animate__fadeInRight" style="animation-delay: 0.3s;">
                <img src="{{ asset('placholder.png') }}" alt="Property">
                <span class="status" style="background: var(--accent-gold); color: var(--primary-dark);">{{ $isAr ? 'محجوز' : 'Reserved' }}</span>
                <h4>{{ $isAr ? 'شقة حديثة' : 'Modern Apartment' }}</h4>
                <p><i class="fas fa-map-marker-alt"></i> {{ $isAr ? 'جدة، حي الروضة' : 'Jeddah, Al Rawdah' }}</p>
                <div class="price">{{ $isAr ? '850,000 ريال' : '850,000 SAR' }}</div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stat-item animate__animated animate__fadeInUp">
            <div class="stat-number">{{ \App\Models\Property::count() }}+</div>
            <div class="stat-label">{{ $isAr ? 'عقار مسجل' : 'Registered Properties' }}</div>
        </div>
        <div class="stat-item animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="stat-number">{{ \App\Models\RequestProperty::count() }}+</div>
            <div class="stat-label">{{ $isAr ? 'طلب نشط' : 'Active Requests' }}</div>
        </div>
        <div class="stat-item animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="stat-number">100%</div>
            <div class="stat-label">{{ $isAr ? 'رضا العملاء' : 'Customer Satisfaction' }}</div>
        </div>
        <div class="stat-item animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <div class="stat-number">24/7</div>
            <div class="stat-label">{{ $isAr ? 'دعم متواصل' : 'Continuous Support' }}</div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-header">
            <h2>{{ $isAr ? 'مميزات النظام' : 'System Features' }}</h2>
            <p>{{ $isAr ? 'كل ما تحتاجه لإدارة عقاراتك بنجاح' : 'Everything you need to manage your properties successfully' }}</p>
        </div>

        <div class="features-grid">
            <div class="feature-card animate__animated animate__fadeInUp">
                <div class="feature-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h3>{{ $isAr ? 'إدارة العقارات' : 'Property Management' }}</h3>
                <p>{{ $isAr ? 'إضافة وتعديل وحذف العقارات بسهولة مع إمكانية إرفاق الصور والمستندات.' : 'Easily add, edit, and delete properties with the ability to attach photos and documents.' }}</p>
            </div>

            <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <div class="feature-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3>{{ $isAr ? 'خرائط تفاعلية' : 'Interactive Maps' }}</h3>
                <p>{{ $isAr ? 'عرض جميع العقارات على الخريطة مع إمكانية تحديد المواقع بدقة ورسم المناطق.' : 'View all properties on the map with the ability to pinpoint locations and draw areas.' }}</p>
            </div>

            <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="feature-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>{{ $isAr ? 'إدارة المواعيد' : 'Appointment Management' }}</h3>
                <p>{{ $isAr ? 'تقويم متكامل لتنظيم مواعيدك مع العملاء والتذكير بالأحداث المهمة.' : 'Integrated calendar to organize your appointments with clients and remind you of important events.' }}</p>
            </div>

            <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <div class="feature-icon">
                    <i class="fas fa-file-contract"></i>
                </div>
                <h3>{{ $isAr ? 'إدارة الطلبات' : 'Request Management' }}</h3>
                <p>{{ $isAr ? 'تتبع طلبات العملاء وإدارتها بكفاءة مع نظام إشعارات متكامل.' : 'Track and manage client requests efficiently with an integrated notification system.' }}</p>
            </div>

            <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>{{ $isAr ? 'تقارير وإحصائيات' : 'Reports & Statistics' }}</h3>
                <p>{{ $isAr ? 'لوحة تحكم شاملة مع رسوم بيانية توضح أداء عملك بشكل واضح.' : 'Comprehensive dashboard with graphs that clearly show your business performance.' }}</p>
            </div>

            <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>{{ $isAr ? 'تصميم متجاوب' : 'Responsive Design' }}</h3>
                <p>{{ $isAr ? 'يعمل على جميع الأجهزة بسلاسة - كمبيوتر، تابلت، وجوال.' : 'Works seamlessly on all devices - computer, tablet, and mobile.' }}</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="about">
        <h2>{{ $isAr ? 'جاهز لإدارة عقاراتك بشكل أفضل؟' : 'Ready to manage your properties better?' }}</h2>
        <p>{{ $isAr ? 'انضم إلينا الآن واستمتع بتجربة إدارة عقارات استثنائية' : 'Join us now and enjoy an exceptional real estate management experience' }}</p>
        <a href="{{ route('login') }}" class="btn-primary">
            <i class="fas fa-user-plus"></i>
            {{ $isAr ? 'سجل الآن مجاناً' : 'Register Now for Free' }}
        </a>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-content">
            <div class="footer-brand">
                <a href="/" class="logo">
                    <img src="{{ asset('upload/123.png') }}" alt="{{ $isAr ? 'أبو نواف' : 'Abu Nawaf' }}">
                </a>
                <p>{{ $isAr ? 'نظام متكامل لإدارة العقارات، يوفر لك كل الأدوات اللازمة لإدارة ممتلكاتك بكفاءة واحترافية.' : 'A complete real estate management system that provides you with all the tools needed to manage your properties efficiently and professionally.' }}</p>
            </div>

            <div class="footer-links">
                <h4>{{ $isAr ? 'روابط سريعة' : 'Quick Links' }}</h4>
                <ul>
                    <li><a href="#features">{{ $isAr ? 'المميزات' : 'Features' }}</a></li>
                    <li><a href="#about">{{ $isAr ? 'من نحن' : 'About Us' }}</a></li>
                    <li><a href="{{ route('login') }}">{{ $isAr ? 'تسجيل الدخول' : 'Login' }}</a></li>
                </ul>
            </div>

            <div class="footer-links footer-contact">
                <h4>{{ $isAr ? 'تواصل معنا' : 'Contact Us' }}</h4>
                <p><i class="fas fa-envelope"></i> info@abunawaf.com</p>
                <p><i class="fas fa-phone"></i> +966 50 000 0000</p>
                <p><i class="fas fa-map-marker-alt"></i> {{ $isAr ? 'الرياض، المملكة العربية السعودية' : 'Riyadh, Saudi Arabia' }}</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ $isAr ? 'أبو نواف للعقارات. جميع الحقوق محفوظة.' : 'Abu Nawaf Real Estate. All rights reserved.' }}</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
