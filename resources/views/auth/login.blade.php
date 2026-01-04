<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - أبو نواف للعقارات</title>
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
            overflow: hidden;
        }

        /* Animated Background */
        .bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
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
        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1100px;
            margin: 20px;
            display: flex;
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        }

        /* Left Side - Welcome */
        .login-welcome {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1a4a47 100%);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-welcome::before {
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
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
        }

        .logo img {
            height: 120px;
            width: auto;
        }

        .login-welcome h2 {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .login-welcome h2 span {
            color: var(--accent-gold);
        }

        .login-welcome p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .features-list {
            list-style: none;
        }

        .features-list li {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
        }

        .features-list li i {
            color: var(--accent-gold);
            font-size: 18px;
        }

        .home-link {
            position: absolute;
            bottom: 30px;
            left: 50px;
        }

        .home-link a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .home-link a:hover {
            color: var(--accent-gold);
        }

        /* Right Side - Form */
        .login-form-container {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
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
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 15px;
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
            font-size: 18px;
            transition: color 0.3s;
        }

        .form-control {
            width: 100%;
            padding: 16px 50px 16px 20px;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            font-size: 16px;
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

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: var(--primary-green);
        }

        .remember-me span {
            color: #666;
            font-size: 14px;
        }

        .forgot-password {
            color: var(--primary-green);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: var(--primary-dark);
        }

        .btn-login {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, var(--primary-green), #1a8a12);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 18px;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(17, 118, 14, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(17, 118, 14, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
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

        .btn-request {
            width: 100%;
            padding: 16px;
            background: white;
            color: var(--accent-gold);
            border: 2px solid var(--accent-gold);
            border-radius: 15px;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-request:hover {
            background: var(--accent-gold);
            color: white;
        }

        .error-message {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 15px;
            border-radius: 10px;
            font-size: 14px;
            margin-top: 8px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }

            .login-welcome {
                padding: 40px 30px;
            }

            .login-welcome h2 {
                font-size: 1.8rem;
            }

            .features-list {
                display: none;
            }

            .home-link {
                position: relative;
                bottom: auto;
                left: auto;
                margin-top: 20px;
            }

            .login-form-container {
                padding: 40px 30px;
            }
        }

        @media (max-width: 576px) {
            .login-container {
                margin: 10px;
                border-radius: 20px;
            }

            .login-welcome,
            .login-form-container {
                padding: 30px 20px;
            }

            .form-header h3 {
                font-size: 1.5rem;
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

    <div class="login-container animate__animated animate__fadeIn">
        <!-- Welcome Side -->
        <div class="login-welcome">
            <div class="welcome-content">
                <div class="logo">
                    <img src="{{ asset('upload/123.png') }}" alt="أبو نواف">
                </div>

                <h2>
                    مرحباً بك في
                    <br>
                    <span>نظام إدارة العقارات</span>
                </h2>

                <p>
                    نظام متكامل لإدارة عقاراتك بكفاءة واحترافية. سجل دخولك للوصول إلى لوحة التحكم.
                </p>

                <ul class="features-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        إدارة شاملة للعقارات
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        خرائط تفاعلية متقدمة
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        تقويم المواعيد والتذكيرات
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        تقارير وإحصائيات مفصلة
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
        <div class="login-form-container">
            <div class="form-header">
                <h3>تسجيل الدخول</h3>
                <p>أدخل بياناتك للوصول إلى حسابك</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <div class="input-wrapper">
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com" required autofocus>
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
                    <label for="password">كلمة المرور</label>
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

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>تذكرني</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            نسيت كلمة المرور؟
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    تسجيل الدخول
                </button>
            </form>

            <div class="divider">
                <span>أو</span>
            </div>

            <a href="{{ route('create.client') }}" class="btn-request">
                <i class="fas fa-file-alt"></i>
                تقديم طلب أرض
            </a>
        </div>
    </div>
</body>
</html>
