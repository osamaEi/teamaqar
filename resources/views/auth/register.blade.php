<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>إنشاء حساب - أبو نواف للعقارات</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-dark: #0F302E;
            --primary-green: #11760E;
            --accent-gold: #F9AB00;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1a4a47 50%, var(--primary-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            padding: 20px;
        }

        /* Animated Background */
        .bg-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }

        .bg-shapes span {
            position: absolute;
            display: block;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.05);
            animation: float 25s linear infinite;
            border-radius: 10px;
        }

        .bg-shapes span:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
        .bg-shapes span:nth-child(2) { top: 60%; left: 80%; animation-delay: -5s; width: 80px; height: 80px; }
        .bg-shapes span:nth-child(3) { top: 40%; left: 30%; animation-delay: -10s; width: 40px; height: 40px; }
        .bg-shapes span:nth-child(4) { top: 80%; left: 50%; animation-delay: -15s; width: 70px; height: 70px; }
        .bg-shapes span:nth-child(5) { top: 10%; left: 70%; animation-delay: -20s; width: 50px; height: 50px; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); opacity: 0.5; }
            50% { transform: translateY(-100px) rotate(180deg); opacity: 0.3; }
            100% { transform: translateY(0) rotate(360deg); opacity: 0.5; }
        }

        /* Main Container */
        .register-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1100px;
            display: flex;
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        }

        /* Left Side - Welcome */
        .register-welcome {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1a4a47 100%);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .register-welcome::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(249, 171, 0, 0.15) 0%, transparent 70%);
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
        }

        .logo img {
            height: 250px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }

        .register-welcome h2 {
            color: white;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .register-welcome h2 span {
            color: var(--accent-gold);
        }

        .register-welcome p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .benefits-list {
            list-style: none;
            text-align: right;
        }

        .benefits-list li {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
        }

        .benefits-list li i {
            color: var(--accent-gold);
            font-size: 18px;
        }

        .home-link {
            margin-top: 30px;
        }

        .home-link a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .home-link a:hover {
            color: var(--accent-gold);
        }

        /* Right Side - Form */
        .register-form-container {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h3 {
            color: var(--primary-dark);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 16px;
            transition: color 0.3s;
        }

        .form-control {
            width: 100%;
            padding: 14px 45px 14px 20px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Cairo', sans-serif;
            transition: all 0.3s;
            background: #f8f9fa;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-green);
            background: white;
            box-shadow: 0 0 0 4px rgba(17, 118, 14, 0.1);
        }

        .form-control:focus + i {
            color: var(--primary-green);
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-green), #1a8a12);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(17, 118, 14, 0.3);
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(17, 118, 14, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e9ecef;
        }

        .divider span {
            padding: 0 20px;
            color: #adb5bd;
            font-size: 14px;
        }

        .login-link {
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: var(--primary-dark);
        }

        .error-message {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-top: 6px;
        }

        /* Responsive Styles */
        @media (max-width: 1200px) {
            .register-container {
                max-width: 950px;
            }

            .register-welcome, .register-form-container {
                padding: 50px 40px;
            }

            .logo img {
                height: 200px;
            }
        }

        @media (max-width: 992px) {
            body {
                padding: 15px;
            }

            .register-container {
                flex-direction: column;
                max-width: 550px;
            }

            .register-welcome {
                padding: 40px 35px;
            }

            .logo img {
                height: 150px;
            }

            .register-welcome h2 {
                font-size: 1.7rem;
            }

            .benefits-list {
                display: none;
            }

            .register-form-container {
                padding: 40px 35px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
                align-items: flex-start;
                padding-top: 20px;
            }

            .register-container {
                border-radius: 25px;
            }

            .register-welcome {
                padding: 30px 25px;
            }

            .logo img {
                height: 120px;
            }

            .register-welcome h2 {
                font-size: 1.4rem;
            }

            .register-welcome p {
                font-size: 13px;
            }

            .register-form-container {
                padding: 30px 25px;
            }

            .form-header h3 {
                font-size: 1.5rem;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .form-control {
                padding: 13px 42px 13px 15px;
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 8px;
            }

            .register-container {
                border-radius: 20px;
            }

            .register-welcome {
                padding: 25px 20px;
            }

            .logo img {
                height: 100px;
            }

            .register-welcome h2 {
                font-size: 1.2rem;
            }

            .register-welcome p {
                font-size: 12px;
            }

            .register-form-container {
                padding: 25px 20px;
            }

            .form-header {
                margin-bottom: 25px;
            }

            .form-header h3 {
                font-size: 1.3rem;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                font-size: 13px;
            }

            .form-control {
                padding: 12px 40px 12px 12px;
                font-size: 13px;
                border-radius: 10px;
            }

            .btn-register {
                padding: 14px;
                font-size: 15px;
                border-radius: 10px;
            }

            .divider {
                margin: 20px 0;
            }
        }

        @media (max-width: 380px) {
            body {
                padding: 5px;
            }

            .register-container {
                border-radius: 15px;
            }

            .register-welcome, .register-form-container {
                padding: 20px 15px;
            }

            .logo img {
                height: 80px;
            }

            .form-header h3 {
                font-size: 1.1rem;
            }

            .form-control {
                padding: 11px 38px 11px 10px;
                font-size: 12px;
            }
        }

        /* Landscape mode */
        @media (max-height: 600px) and (orientation: landscape) {
            body {
                padding: 10px;
                align-items: flex-start;
            }

            .register-container {
                flex-direction: row;
                max-width: 100%;
            }

            .register-welcome {
                padding: 25px;
                min-width: 35%;
            }

            .logo img {
                height: 70px;
            }

            .register-welcome h2 {
                font-size: 1.1rem;
                margin-bottom: 10px;
            }

            .register-welcome p {
                display: none;
            }

            .register-form-container {
                padding: 25px;
            }

            .form-header {
                margin-bottom: 15px;
            }

            .form-group {
                margin-bottom: 10px;
            }

            .form-control {
                padding: 10px 40px 10px 12px;
            }

            .btn-register {
                padding: 11px;
            }

            .divider {
                margin: 15px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background Shapes -->
    <div class="bg-shapes">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="register-container animate__animated animate__fadeIn">
        <!-- Welcome Side -->
        <div class="register-welcome">
            <div class="welcome-content">
                <div class="logo">
                    <img src="{{ asset('upload/123.png') }}" alt="أبو نواف">
                </div>

                <h2>
                    ابدأ رحلتك معنا
                    <br>
                    <span>انضم إلينا اليوم</span>
                </h2>

                <p>
                    أنشئ حسابك المجاني الآن وابدأ بإدارة عقاراتك بكل سهولة واحترافية
                </p>

                <ul class="benefits-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        إضافة وإدارة عقاراتك الخاصة
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        لوحة تحكم شخصية متقدمة
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        تتبع حالة عقاراتك
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        واجهة سهلة الاستخدام
                    </li>
                </ul>

                <div class="home-link">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-arrow-right"></i>
                        العودة للصفحة الرئيسية
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="register-form-container">
            <div class="form-header">
                <h3>{{ __('messages.register') }}</h3>
                <p>املأ البيانات التالية للتسجيل</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">{{ __('messages.name') }}</label>
                    <div class="input-wrapper">
                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="أدخل اسمك الكامل" required autofocus>
                        <i class="fas fa-user"></i>
                    </div>
                    @error('name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">{{ __('messages.email') }}</label>
                    <div class="input-wrapper">
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com" required>
                        <i class="fas fa-envelope"></i>
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('messages.password') }}</label>
                    <div class="input-wrapper">
                        <input id="password" class="form-control" type="password" name="password" placeholder="••••••••" required>
                        <i class="fas fa-lock"></i>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">{{ __('messages.password_confirmation') }}</label>
                    <div class="input-wrapper">
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="••••••••" required>
                        <i class="fas fa-lock"></i>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus"></i>
                    {{ __('messages.register') }}
                </button>
            </form>

            <div class="divider">
                <span>أو</span>
            </div>

            <div class="login-link">
                لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a>
            </div>
        </div>
    </div>
</body>
</html>
