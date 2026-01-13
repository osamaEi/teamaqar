<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أبو نواف للعقارات - مسوق ووسيط عقاري</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-dark: #0F302E;
            --primary-teal: #1B8A8A;
            --accent-gold: #C4A962;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --text-gray: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Cairo', sans-serif;
            overflow-x: hidden;
            background: var(--white);
        }

        /* ==================== NAVBAR ==================== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            background: transparent;
        }

        .navbar.scrolled {
            background: rgba(15, 48, 46, 0.98);
            padding: 10px 5%;
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
            transition: height 0.3s;
        }

        .navbar.scrolled .logo img {
            height: 50px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s;
            position: relative;
            padding: 5px 0;
        }

        .nav-links a:hover {
            color: var(--accent-gold);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 0;
            height: 2px;
            background: var(--accent-gold);
            transition: width 0.3s;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .login-btn {
            background: linear-gradient(135deg, var(--primary-teal), #147a7a);
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(27, 138, 138, 0.4);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(27, 138, 138, 0.5);
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        /* ==================== HERO SECTION ==================== */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1a4a47 50%, var(--primary-dark) 100%);
            position: relative;
            display: flex;
            align-items: center;
            padding: 100px 5% 60px;
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

        .hero-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            gap: 60px;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            flex: 1;
            max-width: 600px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(196, 169, 98, 0.15);
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
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: var(--accent-gold);
        }

        .hero p {
            color: rgba(255,255,255,0.8);
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 35px;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-teal), #147a7a);
            color: white;
            padding: 15px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(27, 138, 138, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(27, 138, 138, 0.5);
        }

        .btn-outline {
            background: transparent;
            color: white;
            padding: 15px 35px;
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

        /* Hero Image/Logo Section */
        .hero-visual {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-logo-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 30px;
            padding: 40px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .hero-logo-container img {
            max-width: 350px;
            height: auto;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* ==================== STATS SECTION ==================== */
        .stats {
            background: white;
            padding: 60px 5%;
        }

        .stats-container {
            display: flex;
            justify-content: center;
            gap: 60px;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-teal));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .stat-label {
            color: var(--text-gray);
            font-size: 16px;
            font-weight: 600;
        }

        /* ==================== FEATURES SECTION ==================== */
        .features {
            background: var(--light-bg);
            padding: 80px 5%;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-header h2 {
            font-size: 2.2rem;
            color: var(--primary-dark);
            margin-bottom: 15px;
        }

        .section-header p {
            color: var(--text-gray);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            padding: 35px 25px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            border-color: var(--primary-teal);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(27, 138, 138, 0.1), rgba(196, 169, 98, 0.1));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .feature-icon i {
            font-size: 28px;
            background: linear-gradient(135deg, var(--primary-teal), var(--accent-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .feature-card h3 {
            color: var(--primary-dark);
            font-size: 1.2rem;
            margin-bottom: 12px;
        }

        .feature-card p {
            color: var(--text-gray);
            font-size: 14px;
            line-height: 1.7;
        }

        /* ==================== CTA SECTION ==================== */
        .cta {
            background: linear-gradient(135deg, var(--primary-dark), #1a4a47);
            padding: 80px 5%;
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
            background: radial-gradient(circle, rgba(196, 169, 98, 0.1) 0%, transparent 50%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .cta-content {
            position: relative;
            z-index: 1;
            max-width: 700px;
            margin: 0 auto;
        }

        .cta h2 {
            color: white;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .cta p {
            color: rgba(255,255,255,0.8);
            font-size: 1.1rem;
            margin-bottom: 35px;
        }

        .cta .btn-primary {
            background: var(--accent-gold);
            color: var(--primary-dark);
        }

        /* ==================== FOOTER ==================== */
        .footer {
            background: var(--primary-dark);
            padding: 50px 5% 25px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto 40px;
        }

        .footer-brand {
            max-width: 300px;
        }

        .footer-brand img {
            height: 80px;
            margin-bottom: 15px;
        }

        .footer-brand p {
            color: rgba(255,255,255,0.6);
            font-size: 14px;
            line-height: 1.8;
        }

        .footer-links h4 {
            color: white;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--accent-gold);
        }

        .footer-contact p {
            color: rgba(255,255,255,0.6);
            margin-bottom: 10px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-contact i {
            color: var(--accent-gold);
            width: 20px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 25px;
            text-align: center;
            color: rgba(255,255,255,0.4);
            font-size: 14px;
        }

        /* ==================== RESPONSIVE DESIGN ==================== */

        /* Tablet Landscape */
        @media (max-width: 1200px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-logo-container img {
                max-width: 280px;
            }

            .stat-number {
                font-size: 3rem;
            }
        }

        /* Tablet Portrait */
        @media (max-width: 992px) {
            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 280px;
                height: 100vh;
                background: var(--primary-dark);
                flex-direction: column;
                justify-content: center;
                gap: 30px;
                transition: right 0.3s ease;
                box-shadow: -5px 0 30px rgba(0,0,0,0.3);
            }

            .nav-links.active {
                right: 0;
            }

            .nav-links a {
                font-size: 18px;
            }

            .menu-toggle {
                display: block;
                z-index: 1001;
            }

            .hero-container {
                flex-direction: column;
                text-align: center;
            }

            .hero-content {
                max-width: 100%;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-visual {
                width: 100%;
            }

            .hero-logo-container {
                padding: 30px;
            }

            .hero-logo-container img {
                max-width: 220px;
            }

            .stats-container {
                gap: 30px;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .section-header h2 {
                font-size: 1.8rem;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-brand {
                max-width: 100%;
            }

            .footer-contact p {
                justify-content: center;
            }
        }

        /* Mobile Landscape */
        @media (max-width: 768px) {
            .navbar {
                padding: 12px 4%;
            }

            .logo img {
                height: 50px;
            }

            .hero {
                padding: 90px 4% 50px;
                min-height: auto;
            }

            .hero h1 {
                font-size: 1.9rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero-badge {
                font-size: 12px;
                padding: 6px 15px;
            }

            .btn-primary, .btn-outline {
                padding: 12px 25px;
                font-size: 14px;
                width: 100%;
                justify-content: center;
            }

            .hero-logo-container {
                padding: 25px;
            }

            .hero-logo-container img {
                max-width: 180px;
            }

            .stats {
                padding: 40px 4%;
            }

            .stat-item {
                padding: 15px;
                width: 45%;
            }

            .stat-number {
                font-size: 2rem;
            }

            .stat-label {
                font-size: 14px;
            }

            .features {
                padding: 60px 4%;
            }

            .features-grid {
                gap: 20px;
            }

            .feature-card {
                padding: 25px 20px;
            }

            .cta {
                padding: 60px 4%;
            }

            .cta h2 {
                font-size: 1.6rem;
            }

            .footer {
                padding: 40px 4% 20px;
            }
        }

        /* Mobile Portrait */
        @media (max-width: 576px) {
            .navbar {
                padding: 10px 3%;
            }

            .logo img {
                height: 45px;
            }

            .navbar.scrolled .logo img {
                height: 40px;
            }

            .hero {
                padding: 80px 3% 40px;
            }

            .hero h1 {
                font-size: 1.6rem;
            }

            .hero p {
                font-size: 0.95rem;
                margin-bottom: 25px;
            }

            .hero-badge {
                font-size: 11px;
                padding: 5px 12px;
                margin-bottom: 20px;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 12px;
            }

            .hero-logo-container {
                padding: 20px;
                border-radius: 20px;
            }

            .hero-logo-container img {
                max-width: 150px;
            }

            .stats {
                padding: 30px 3%;
            }

            .stats-container {
                gap: 15px;
            }

            .stat-item {
                padding: 10px;
            }

            .stat-number {
                font-size: 1.8rem;
            }

            .stat-label {
                font-size: 12px;
            }

            .features {
                padding: 50px 3%;
            }

            .section-header {
                margin-bottom: 35px;
            }

            .section-header h2 {
                font-size: 1.5rem;
            }

            .section-header p {
                font-size: 0.95rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .feature-icon {
                width: 60px;
                height: 60px;
            }

            .feature-icon i {
                font-size: 24px;
            }

            .cta {
                padding: 50px 3%;
            }

            .cta h2 {
                font-size: 1.4rem;
            }

            .cta p {
                font-size: 0.95rem;
            }

            .footer {
                padding: 35px 3% 15px;
            }

            .footer-brand img {
                height: 60px;
            }

            .footer-links h4 {
                font-size: 15px;
            }

            .footer-bottom {
                font-size: 12px;
            }
        }

        /* Extra Small Screens */
        @media (max-width: 380px) {
            .hero h1 {
                font-size: 1.4rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .hero-logo-container img {
                max-width: 130px;
            }
        }

        /* Close Menu Button */
        .close-menu {
            display: none;
            position: absolute;
            top: 20px;
            left: 20px;
            background: none;
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
        }

        @media (max-width: 992px) {
            .close-menu {
                display: block;
            }
        }

        /* Overlay for mobile menu */
        .nav-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .nav-overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <a href="/" class="logo">
            <img src="{{ asset('upload/123.png') }}" alt="أبو نواف للعقارات">
        </a>

        <div class="nav-overlay" id="navOverlay"></div>

        <div class="nav-links" id="navLinks">
            <button class="close-menu" id="closeMenu">
                <i class="fas fa-times"></i>
            </button>
            <a href="#features">المميزات</a>
            <a href="#about">من نحن</a>
            <a href="#contact">تواصل معنا</a>
            <a href="{{ route('login') }}" class="login-btn">
                <i class="fas fa-sign-in-alt"></i>
                تسجيل الدخول
            </a>
        </div>

        <button class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content animate__animated animate__fadeInUp">
                <div class="hero-badge">
                    <i class="fas fa-star"></i>
                    مسوق ووسيط عقاري معتمد
                </div>

                <h1>
                    نظام متكامل لإدارة
                    <br>
                    <span>العقارات باحترافية</span>
                </h1>

                <p>
                    نقدم لك أفضل الحلول لإدارة عقاراتك، تتبع الطلبات، وتنظيم المواعيد. نظام شامل يجمع كل احتياجاتك العقارية في مكان واحد.
                </p>

                <div class="hero-buttons">
                    <a href="{{ route('login') }}" class="btn-primary">
                        <i class="fas fa-rocket"></i>
                        ابدأ الآن
                    </a>
                    <a href="#features" class="btn-outline">
                        <i class="fas fa-info-circle"></i>
                        تعرف على المزيد
                    </a>
                </div>
            </div>

            <div class="hero-visual animate__animated animate__fadeInLeft">
                <div class="hero-logo-container">
                    <img src="{{ asset('upload/123.png') }}" alt="أبو نواف للعقارات">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item animate__animated animate__fadeInUp">
                <div class="stat-number">{{ \App\Models\Property::count() ?: '50' }}+</div>
                <div class="stat-label">عقار مسجل</div>
            </div>
            <div class="stat-item animate__animated animate__fadeInUp">
                <div class="stat-number">{{ \App\Models\RequestProperty::count() ?: '25' }}+</div>
                <div class="stat-label">طلب نشط</div>
            </div>
            <div class="stat-item animate__animated animate__fadeInUp">
                <div class="stat-number">100%</div>
                <div class="stat-label">رضا العملاء</div>
            </div>
            <div class="stat-item animate__animated animate__fadeInUp">
                <div class="stat-number">24/7</div>
                <div class="stat-label">دعم متواصل</div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-header">
            <h2>مميزات النظام</h2>
            <p>كل ما تحتاجه لإدارة عقاراتك بنجاح</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h3>إدارة العقارات</h3>
                <p>إضافة وتعديل وحذف العقارات بسهولة مع إمكانية إرفاق الصور والمستندات</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3>خرائط تفاعلية</h3>
                <p>عرض جميع العقارات على الخريطة مع إمكانية تحديد المواقع بدقة</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>إدارة المواعيد</h3>
                <p>تقويم متكامل لتنظيم مواعيدك مع العملاء والتذكير بالأحداث المهمة</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>إدارة العملاء</h3>
                <p>تتبع العملاء والملاك والوسطاء مع إرسال العروض عبر الواتساب والإيميل</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>تقارير وإحصائيات</h3>
                <p>لوحة تحكم شاملة مع رسوم بيانية توضح أداء عملك</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>تصميم متجاوب</h3>
                <p>يعمل على جميع الأجهزة بسلاسة - كمبيوتر، تابلت، وجوال</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="about">
        <div class="cta-content">
            <h2>جاهز لإدارة عقاراتك بشكل أفضل؟</h2>
            <p>انضم إلينا الآن واستمتع بتجربة إدارة عقارات استثنائية</p>
            <a href="{{ route('login') }}" class="btn-primary">
                <i class="fas fa-user-plus"></i>
                سجل الآن مجاناً
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-content">
            <div class="footer-brand">
                <img src="{{ asset('upload/123.png') }}" alt="أبو نواف للعقارات">
                <p>نظام متكامل لإدارة العقارات، يوفر لك كل الأدوات اللازمة لإدارة ممتلكاتك بكفاءة واحترافية</p>
            </div>

            <div class="footer-links">
                <h4>روابط سريعة</h4>
                <ul>
                    <li><a href="#features">المميزات</a></li>
                    <li><a href="#about">من نحن</a></li>
                    <li><a href="{{ route('login') }}">تسجيل الدخول</a></li>
                </ul>
            </div>

            <div class="footer-links footer-contact">
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
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');
        const closeMenu = document.getElementById('closeMenu');
        const navOverlay = document.getElementById('navOverlay');

        menuToggle.addEventListener('click', function() {
            navLinks.classList.add('active');
            navOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        closeMenu.addEventListener('click', function() {
            navLinks.classList.remove('active');
            navOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });

        navOverlay.addEventListener('click', function() {
            navLinks.classList.remove('active');
            navOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });

        // Close menu when clicking nav links
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', function() {
                navLinks.classList.remove('active');
                navOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
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
