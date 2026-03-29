<nav class="main-header navbar navbar-expand navbar-light">

    <!-- ── Right side (RTL start) ── -->
    <ul class="navbar-nav">

        <!-- Sidebar Toggle -->
        <li class="nav-item">
            <a class="nav-link nav-icon-btn" data-widget="pushmenu" href="#" title="القائمة">
                <i class="fas fa-bars"></i>
            </a>
        </li>

        <!-- Page breadcrumb (md+) -->
        <li class="nav-item d-none d-md-flex align-items-center mr-2">
            <span class="nav-breadcrumb">
                <i class="fas fa-home text-muted" style="font-size:12px;"></i>
                <span class="mx-1 text-muted" style="font-size:12px;">/</span>
                <span id="nav-page-title" style="font-size:13px; font-weight:600; color:#0F302E;">لوحة التحكم</span>
            </span>
        </li>
    </ul>

    <!-- ── Search (center, md+) ── -->
    <form class="d-none d-lg-flex nav-search-form" onsubmit="navSearch(event)">
        <div class="nav-search-wrap">
            <i class="fas fa-search nav-search-icon"></i>
            <input type="text" id="nav-search-input" placeholder="بحث في العقارات والطلبات..." class="nav-search-input" autocomplete="off">
            <kbd class="nav-search-kbd">Ctrl+K</kbd>
        </div>
    </form>

    <!-- ── Left side (RTL end) ── -->
    <ul class="navbar-nav mr-auto d-flex align-items-center">

        @if(Auth::check())

        <!-- Clock -->
        <li class="nav-item d-none d-xl-flex align-items-center">
            <div class="nav-clock-wrap">
                <span id="nav-time" style="font-weight:700; font-size:14px; color:#0F302E; font-variant-numeric:tabular-nums;"></span>
                <span id="nav-date" style="font-size:11px; color:#6c757d; display:block; line-height:1;"></span>
            </div>
        </li>

        <li class="nav-item d-none d-xl-block nav-divider"></li>

        <!-- Add Property -->
        <li class="nav-item d-none d-md-block">
            <a href="{{ route('property.create.page') }}" class="btn-nav-primary">
                <i class="fas fa-plus"></i>
                <span class="d-none d-lg-inline mr-1">عقار جديد</span>
            </a>
        </li>

        <!-- Fullscreen -->
        <li class="nav-item">
            <a class="nav-link nav-icon-btn" data-widget="fullscreen" href="#" title="ملء الشاشة">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- Notifications -->
        <li class="nav-item dropdown">
            <a class="nav-link nav-icon-btn position-relative" data-toggle="dropdown" href="#" title="الإشعارات">
                <i class="fas fa-bell"></i>
                @php
                    $unreadNotifCount = \App\Models\RequestProperty::whereDate('created_at', \Carbon\Carbon::today())->count();
                @endphp
                @if($unreadNotifCount > 0)
                    <span class="nav-badge">{{ $unreadNotifCount > 9 ? '9+' : $unreadNotifCount }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-left notif-dropdown animate__animated animate__fadeIn">
                <div class="notif-header">
                    <span style="font-weight:700; font-size:14px;">الإشعارات</span>
                    @if($unreadNotifCount > 0)
                        <span class="badge badge-pill" style="background:#0F302E; color:white; font-size:11px;">{{ $unreadNotifCount }} جديد</span>
                    @endif
                </div>
                @php
                    $latestRequests = \App\Models\RequestProperty::latest()->take(5)->get();
                @endphp
                @forelse($latestRequests as $req)
                <a class="dropdown-item notif-item" href="{{ route('requests.index') }}">
                    <div class="notif-avatar"><i class="fas fa-user"></i></div>
                    <div class="notif-content">
                        <div class="notif-title">طلب من {{ $req->name }}</div>
                        <div class="notif-time">{{ $req->created_at->diffForHumans() }}</div>
                    </div>
                </a>
                @empty
                <div class="notif-empty"><i class="fas fa-inbox"></i><p>لا توجد إشعارات</p></div>
                @endforelse
                <a href="{{ route('requests.index') }}" class="notif-footer">عرض كل الطلبات</a>
            </div>
        </li>

        <li class="nav-item nav-divider d-none d-md-block"></li>

        <!-- User Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link p-0 user-chip" data-toggle="dropdown" href="#">
                <div class="d-none d-md-flex flex-column text-right" style="line-height:1.3; margin-left:10px;">
                    <span style="font-weight:700; color:#0F302E; font-size:13px;">{{ Auth::user()->name }}</span>
                    <span style="font-size:11px; color:#6c757d;">مدير النظام</span>
                </div>
                <div class="user-avatar-wrap">
                    <img src="{{ Auth::user()->photo ? asset('upload/profile/' . Auth::user()->photo) : asset('dist/img/user2-160x160.jpg') }}"
                         alt="avatar" class="user-avatar">
                    <span class="user-online-dot"></span>
                </div>
                <i class="fas fa-chevron-down d-none d-md-block" style="font-size:10px; color:#adb5bd; margin-right:6px;"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-left user-dropdown animate__animated animate__fadeIn">
                <!-- User header -->
                <div class="user-dd-header">
                    <img src="{{ Auth::user()->photo ? asset('upload/profile/' . Auth::user()->photo) : asset('dist/img/user2-160x160.jpg') }}"
                         class="user-dd-avatar">
                    <h6>{{ Auth::user()->name }}</h6>
                    <small>{{ Auth::user()->email }}</small>
                </div>

                <div class="user-dd-body">
                    <a class="dropdown-item user-dd-item" href="{{ route('profile.edit') }}">
                        <span class="user-dd-icon" style="background:#e3f2fd;"><i class="fas fa-user" style="color:#1976d2;"></i></span>
                        الملف الشخصي
                    </a>
                    <a class="dropdown-item user-dd-item" href="{{ route('calender.index') }}">
                        <span class="user-dd-icon" style="background:#fff3e0;"><i class="fas fa-calendar-alt" style="color:#f57c00;"></i></span>
                        المواعيد والتقويم
                    </a>
                    <a class="dropdown-item user-dd-item" href="{{ route('properties.page') }}">
                        <span class="user-dd-icon" style="background:#e8f5e9;"><i class="fas fa-building" style="color:#388e3c;"></i></span>
                        إدارة العقارات
                    </a>
                    <a class="dropdown-item user-dd-item" href="{{ route('requests.index') }}">
                        <span class="user-dd-icon" style="background:#fce4ec;"><i class="fas fa-clipboard-list" style="color:#c62828;"></i></span>
                        طلبات العملاء
                    </a>
                </div>

                <div class="user-dd-footer">
                    <a class="dropdown-item user-dd-item text-danger" href="{{ route('employee.logout') }}">
                        <span class="user-dd-icon" style="background:#ffebee;"><i class="fas fa-sign-out-alt" style="color:#dc3545;"></i></span>
                        تسجيل الخروج
                    </a>
                </div>
            </div>
        </li>

        @else
        <li class="nav-item">
            <a class="btn-nav-primary" href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i>
                <span class="mr-1">تسجيل الدخول</span>
            </a>
        </li>
        @endif
    </ul>
</nav>

<style>
/* ════════════════════════════════════════
   TOP NAV — Base
════════════════════════════════════════ */
.main-header.navbar {
    background: #ffffff;
    border-bottom: 1px solid #e9ecef;
    min-height: 64px;
    padding: 0 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
    z-index: 1030;
}

/* ── Icon buttons ── */
.nav-icon-btn {
    width: 40px !important;
    height: 40px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 10px !important;
    color: #495057 !important;
    font-size: 16px !important;
    transition: background .2s, color .2s !important;
    padding: 0 !important;
}
.nav-icon-btn:hover {
    background: #f1f3f5 !important;
    color: #0F302E !important;
}

/* ── Breadcrumb ── */
.nav-breadcrumb {
    display: flex;
    align-items: center;
    padding: 6px 12px;
    background: #f8f9fa;
    border-radius: 8px;
    gap: 4px;
}

/* ── Search ── */
.nav-search-form {
    flex: 1;
    max-width: 380px;
    margin: 0 24px;
}
.nav-search-wrap {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border: 1.5px solid transparent;
    border-radius: 12px;
    padding: 8px 14px;
    width: 100%;
    transition: border-color .2s, box-shadow .2s;
}
.nav-search-wrap:focus-within {
    border-color: #0F302E;
    box-shadow: 0 0 0 3px rgba(15,48,46,.08);
    background: #fff;
}
.nav-search-icon {
    color: #adb5bd;
    font-size: 13px;
    flex-shrink: 0;
}
.nav-search-input {
    border: none;
    background: transparent;
    outline: none;
    font-size: 13px;
    color: #212529;
    width: 100%;
    margin-right: 10px;
    direction: rtl;
}
.nav-search-input::placeholder { color: #adb5bd; }
.nav-search-kbd {
    background: #e9ecef;
    border-radius: 5px;
    padding: 2px 6px;
    font-size: 10px;
    color: #6c757d;
    font-family: monospace;
    flex-shrink: 0;
    margin-right: 8px;
}

/* ── Clock ── */
.nav-clock-wrap {
    text-align: center;
    padding: 0 8px;
}

/* ── Divider ── */
.nav-divider {
    height: 28px;
    width: 1px;
    background: #dee2e6;
    margin: 0 6px;
    display: block;
}

/* ── Primary action button ── */
.btn-nav-primary {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #0F302E 0%, #1a5c3a 100%);
    color: white !important;
    border-radius: 10px;
    padding: 9px 16px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none !important;
    transition: opacity .2s, transform .1s;
    white-space: nowrap;
}
.btn-nav-primary:hover { opacity: .88; transform: translateY(-1px); }

/* ── Notification badge ── */
.nav-badge {
    position: absolute;
    top: 4px;
    left: 4px;
    background: #e53935;
    color: white;
    font-size: 9px;
    font-weight: 700;
    min-width: 16px;
    height: 16px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid white;
    padding: 0 3px;
    line-height: 1;
}

/* ── Notification dropdown ── */
.notif-dropdown {
    width: 320px;
    border: none;
    box-shadow: 0 12px 40px rgba(0,0,0,.15);
    border-radius: 16px;
    overflow: hidden;
    padding: 0;
    margin-top: 10px;
}
.notif-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid #f1f3f5;
    background: #fafafa;
}
.notif-item {
    display: flex !important;
    align-items: center;
    gap: 12px;
    padding: 12px 20px !important;
    border-bottom: 1px solid #f8f9fa;
    transition: background .15s;
}
.notif-item:hover { background: #f8f9fa !important; }
.notif-avatar {
    width: 38px;
    height: 38px;
    background: linear-gradient(135deg, #0F302E, #1a5c3a);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    flex-shrink: 0;
}
.notif-content { flex: 1; min-width: 0; }
.notif-title { font-size: 13px; font-weight: 600; color: #212529; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.notif-time { font-size: 11px; color: #adb5bd; margin-top: 2px; }
.notif-empty { text-align: center; padding: 30px 20px; color: #adb5bd; }
.notif-empty i { font-size: 32px; margin-bottom: 8px; display: block; }
.notif-empty p { margin: 0; font-size: 13px; }
.notif-footer {
    display: block;
    text-align: center;
    padding: 12px;
    font-size: 13px;
    font-weight: 600;
    color: #0F302E !important;
    background: #f8f9fa;
    text-decoration: none !important;
    border-top: 1px solid #e9ecef;
    transition: background .15s;
}
.notif-footer:hover { background: #e9ecef; }

/* ── User chip ── */
.user-chip {
    display: flex !important;
    align-items: center !important;
    background: #f8f9fa !important;
    border-radius: 12px !important;
    padding: 6px 10px !important;
    transition: background .2s !important;
}
.user-chip:hover { background: #e9ecef !important; }
.user-avatar-wrap { position: relative; }
.user-avatar {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid #0F302E;
    display: block;
}
.user-online-dot {
    position: absolute;
    bottom: -2px;
    right: -2px;
    width: 11px;
    height: 11px;
    background: #22c55e;
    border-radius: 50%;
    border: 2px solid white;
}

/* ── User dropdown ── */
.user-dropdown {
    width: 240px;
    border: none;
    box-shadow: 0 12px 40px rgba(0,0,0,.15);
    border-radius: 16px;
    overflow: hidden;
    padding: 0;
    margin-top: 10px;
}
.user-dd-header {
    padding: 20px 16px 16px;
    text-align: center;
    background: linear-gradient(135deg, #0F302E 0%, #1a4a2e 100%);
    color: white;
}
.user-dd-avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255,255,255,.4);
    margin-bottom: 10px;
}
.user-dd-header h6 { margin: 0; font-weight: 700; font-size: 15px; color: white; }
.user-dd-header small { color: rgba(255,255,255,.7); font-size: 11px; }
.user-dd-body { padding: 8px 0; }
.user-dd-footer { padding: 8px 0; border-top: 1px solid #e9ecef; }
.user-dd-item {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    padding: 10px 16px !important;
    font-size: 13px !important;
    color: #212529 !important;
    transition: background .15s !important;
}
.user-dd-item:hover { background: #f8f9fa !important; }
.user-dd-item.text-danger { color: #dc3545 !important; }
.user-dd-icon {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
}
</style>

<script>
/* ── Live clock ── */
(function clock() {
    var t = document.getElementById('nav-time');
    var d = document.getElementById('nav-date');
    if (!t) return;
    function tick() {
        var now = new Date();
        var hh = String(now.getHours()).padStart(2,'0');
        var mm = String(now.getMinutes()).padStart(2,'0');
        var ss = String(now.getSeconds()).padStart(2,'0');
        t.textContent = hh + ':' + mm + ':' + ss;
        var days   = ['الأحد','الإثنين','الثلاثاء','الأربعاء','الخميس','الجمعة','السبت'];
        var months = ['يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'];
        d.textContent = days[now.getDay()] + ' ' + now.getDate() + ' ' + months[now.getMonth()];
    }
    tick();
    setInterval(tick, 1000);
})();

/* ── Keyboard shortcut Ctrl+K → focus search ── */
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        var s = document.getElementById('nav-search-input');
        if (s) { s.focus(); s.select(); }
    }
});

/* ── Search submit ── */
function navSearch(e) {
    e.preventDefault();
    var q = document.getElementById('nav-search-input').value.trim();
    if (q) window.location.href = '{{ route("properties.page") }}?search=' + encodeURIComponent(q);
}

/* ── Auto set breadcrumb from <title> ── */
document.addEventListener('DOMContentLoaded', function() {
    var el = document.getElementById('nav-page-title');
    if (!el) return;
    var title = document.title.replace(/\s*[-|].*$/, '').trim();
    if (title) el.textContent = title;
});
</script>
