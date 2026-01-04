<nav class="main-header navbar navbar-expand navbar-light" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); border-bottom: 2px solid #e9ecef; min-height: 60px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link sidebar-toggle" data-widget="pushmenu" href="#" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 12px; background: #f8f9fa; margin-right: 10px; transition: all 0.3s;">
                <i class="fas fa-bars" style="color: #0F302E; font-size: 18px;"></i>
            </a>
        </li>
    </ul>

    <!-- Search Bar -->
    <div class="d-none d-md-flex align-items-center" style="background: #f8f9fa; border-radius: 12px; padding: 8px 16px; min-width: 300px;">
        <i class="fas fa-search" style="color: #6c757d; font-size: 14px;"></i>
        <input type="text" placeholder="بحث في العقارات، الطلبات..."
               style="border: none; background: transparent; outline: none; margin-right: 12px; font-size: 14px; width: 100%; color: #495057;"
               class="search-input">
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto d-flex align-items-center" style="gap: 8px;">
        @if (Auth::check())

        <!-- Quick Actions -->
        <li class="nav-item d-none d-lg-block">
            <a href="{{ route('property.create.page') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #11760E 0%, #1a5c3a 100%); color: white; border-radius: 10px; padding: 8px 16px; font-size: 13px; font-weight: 600;">
                <i class="fas fa-plus ml-2"></i> عقار جديد
            </a>
        </li>

        <!-- Calendar -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('calender.index') }}" style="width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; border-radius: 12px; background: #f8f9fa; transition: all 0.3s;" title="التقويم">
                <i class="fas fa-calendar-alt" style="color: #0F302E; font-size: 16px;"></i>
            </a>
        </li>

        <!-- Fullscreen -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" style="width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; border-radius: 12px; background: #f8f9fa; transition: all 0.3s;" title="ملء الشاشة">
                <i class="fas fa-expand-arrows-alt" style="color: #0F302E; font-size: 16px;"></i>
            </a>
        </li>

        <!-- Divider -->
        <li class="nav-item d-none d-md-block" style="height: 30px; width: 1px; background: #dee2e6; margin: 0 8px;"></li>

        <!-- User Profile Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link p-0" data-toggle="dropdown" href="#" style="display: flex; align-items: center; gap: 12px; padding: 6px 12px 6px 6px; background: #f8f9fa; border-radius: 12px; transition: all 0.3s;">
                <div class="d-none d-md-flex flex-column text-right" style="line-height: 1.3;">
                    <span style="font-weight: 700; color: #0F302E; font-size: 14px;">{{ Auth::user()->name }}</span>
                    <span style="font-size: 11px; color: #6c757d;">مدير النظام</span>
                </div>
                <div style="position: relative;">
                    <img src="{{ Auth::user()->photo ? asset('upload/profile/' . Auth::user()->photo) : asset('dist/img/user2-160x160.jpg') }}"
                         alt="User Avatar"
                         style="width: 40px; height: 40px; border-radius: 12px; object-fit: cover; border: 2px solid #0F302E;">
                    <span style="position: absolute; bottom: -2px; right: -2px; width: 12px; height: 12px; background: #11760E; border-radius: 50%; border: 2px solid white;"></span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right animate__animated animate__fadeIn" style="border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.15); border-radius: 15px; padding: 12px 0; min-width: 220px; margin-top: 10px;">
                <!-- User Info Header -->
                <div class="px-4 py-3 text-center" style="border-bottom: 1px solid #e9ecef;">
                    <img src="{{ Auth::user()->photo ? asset('upload/profile/' . Auth::user()->photo) : asset('dist/img/user2-160x160.jpg') }}"
                         style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 3px solid #0F302E; margin-bottom: 10px;">
                    <h6 style="margin: 0; font-weight: 700; color: #0F302E;">{{ Auth::user()->name }}</h6>
                    <small style="color: #6c757d;">{{ Auth::user()->email }}</small>
                </div>

                <div class="py-2">
                    <a class="dropdown-item py-2" href="{{ route('profile.edit') }}" style="display: flex; align-items: center; gap: 12px; font-size: 14px;">
                        <span style="width: 32px; height: 32px; background: #e3f2fd; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user" style="color: #1976d2;"></i>
                        </span>
                        الملف الشخصي
                    </a>
                    <a class="dropdown-item py-2" href="{{ route('calender.index') }}" style="display: flex; align-items: center; gap: 12px; font-size: 14px;">
                        <span style="width: 32px; height: 32px; background: #fff3e0; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-calendar" style="color: #f57c00;"></i>
                        </span>
                        المواعيد
                    </a>
                    <a class="dropdown-item py-2" href="{{ route('properties.page') }}" style="display: flex; align-items: center; gap: 12px; font-size: 14px;">
                        <span style="width: 32px; height: 32px; background: #e8f5e9; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-building" style="color: #388e3c;"></i>
                        </span>
                        العقارات
                    </a>
                </div>

                <div style="border-top: 1px solid #e9ecef; padding-top: 8px; margin-top: 4px;">
                    <a class="dropdown-item py-2" href="{{ route('employee.logout') }}" style="display: flex; align-items: center; gap: 12px; font-size: 14px; color: #dc3545;">
                        <span style="width: 32px; height: 32px; background: #ffebee; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-sign-out-alt" style="color: #dc3545;"></i>
                        </span>
                        تسجيل الخروج
                    </a>
                </div>
            </div>
        </li>

        @else
        <li class="nav-item">
            <a class="btn" href="{{ route('login') }}" style="background: linear-gradient(135deg, #0F302E 0%, #1a5c3a 100%); color: white; border-radius: 12px; padding: 10px 24px; font-weight: 600;">
                <i class="fas fa-sign-in-alt ml-2"></i> تسجيل الدخول
            </a>
        </li>
        @endif
    </ul>
</nav>

<style>
    .main-header .sidebar-toggle:hover {
        background: #0F302E !important;
    }
    .main-header .sidebar-toggle:hover i {
        color: white !important;
    }
    .main-header .nav-link:hover {
        background: #e9ecef !important;
    }
    .main-header .dropdown-item:hover {
        background: #f8f9fa;
    }
    .main-header .search-input::placeholder {
        color: #adb5bd;
    }
</style>
