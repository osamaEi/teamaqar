<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم استلام طلبك - أبو نواف للعقارات</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-dark: #0F302E; --primary-teal: #1B8A8A; --accent-gold: #C4A962; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1a4a47 100%);
            display: flex; align-items: center; justify-content: center;
            padding: 30px;
        }
        .card {
            background: white; border-radius: 28px;
            padding: 60px 50px; text-align: center;
            max-width: 540px; width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,.25);
            animation: popIn .5s cubic-bezier(.175,.885,.32,1.275);
        }
        @keyframes popIn { from { opacity:0; transform:scale(.88); } to { opacity:1; transform:scale(1); } }

        .check-circle {
            width: 90px; height: 90px; border-radius: 50%;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 28px;
            box-shadow: 0 8px 30px rgba(34,197,94,.35);
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse { 0%,100% { box-shadow: 0 8px 30px rgba(34,197,94,.35); } 50% { box-shadow: 0 8px 40px rgba(34,197,94,.55); } }
        .check-circle i { font-size: 40px; color: white; }

        h1 { font-size: 1.9rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 14px; }
        p { color: #6c757d; font-size: 15px; line-height: 1.8; margin-bottom: 10px; }

        .divider { border: none; border-top: 1.5px solid #f0f0f0; margin: 28px 0; }

        .info-row { display: flex; align-items: center; gap: 12px; background: #f8f9fa; border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; text-align: right; }
        .info-row i { color: var(--primary-teal); font-size: 18px; flex-shrink: 0; }
        .info-row span { font-size: 14px; color: #444; font-weight: 600; }

        .btn-home {
            display: inline-flex; align-items: center; gap: 10px;
            background: linear-gradient(135deg, var(--primary-dark), #1a4a47);
            color: white; padding: 14px 36px; border-radius: 50px;
            font-family: 'Cairo', sans-serif; font-size: 15px; font-weight: 700;
            text-decoration: none; margin-top: 28px;
            transition: opacity .2s, transform .15s;
            box-shadow: 0 6px 20px rgba(15,48,46,.3);
        }
        .btn-home:hover { opacity: .88; transform: translateY(-2px); color: white; text-decoration: none; }

        .btn-more {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--accent-gold); color: var(--primary-dark);
            padding: 12px 28px; border-radius: 50px;
            font-family: 'Cairo', sans-serif; font-size: 14px; font-weight: 700;
            text-decoration: none; margin-top: 12px; margin-right: 10px;
            transition: opacity .2s, transform .15s;
        }
        .btn-more:hover { opacity: .88; transform: translateY(-2px); color: var(--primary-dark); text-decoration: none; }

        .ref-note { font-size: 13px; color: #adb5bd; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="check-circle">
            <i class="fas fa-check"></i>
        </div>

        <h1>تم استلام طلبك!</h1>
        <p>شكراً لتواصلك معنا. تم استلام طلبك بنجاح وسيقوم فريقنا بالتواصل معك في أقرب وقت ممكن.</p>

        <div class="divider"></div>

        <div class="info-row">
            <i class="fas fa-clock"></i>
            <span>سيتم التواصل معك خلال 24 ساعة عمل</span>
        </div>
        <div class="info-row">
            <i class="fab fa-whatsapp"></i>
            <span>قد يتواصل معك فريقنا عبر واتساب أو الهاتف</span>
        </div>
        <div class="info-row">
            <i class="fas fa-building"></i>
            <span>سنحرص على إيجاد أفضل خيار يناسب احتياجاتك</span>
        </div>

        <div>
            <a href="/" class="btn-home"><i class="fas fa-home"></i> الرئيسية</a>
            <a href="{{ route('clients.index') }}" class="btn-more"><i class="fas fa-search"></i> تصفح العقارات</a>
        </div>

        <p class="ref-note"><i class="fas fa-shield-alt"></i> طلبك محفوظ بأمان في نظامنا</p>
    </div>
</body>
</html>
