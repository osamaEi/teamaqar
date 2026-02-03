@if (Auth::check())

<aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('user.dashboard') }}" class="brand-link">
        <div class="brand-logo-custom">
            <i class="fas fa-home"></i>
        </div>
        <span class="brand-text font-weight-light">أبو نواف للعقارات</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->photo ? asset('upload/profile/' . Auth::user()->photo) : asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white">{{ Auth::user()->name }}</a>
                <small class="text-white-50">مستخدم</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>لوحة التحكم</p>
                    </a>
                </li>

                <!-- My Properties -->
                <li class="nav-item {{ request()->routeIs('user.properties.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('user.properties.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            عقاراتي
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.properties.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>قائمة عقاراتي</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.properties.create') }}" class="nav-link {{ request()->routeIs('user.properties.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>إضافة عقار جديد</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Profile -->
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>إعدادات الحساب</p>
                    </a>
                </li>

                <!-- Divider -->
                <li class="nav-header">روابط سريعة</li>

                <!-- Main Website -->
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            الموقع الرئيسي
                            <i class="fas fa-external-link-alt right" style="font-size: 11px;"></i>
                        </p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-right" style="width: 100%; border: none; background: none; padding: 8px 16px;">
                            <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                            <p class="text-danger" style="display: inline;">تسجيل الخروج</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

@endif

<style>
    .main-sidebar {
        background: linear-gradient(180deg, #0F302E 0%, #1a4a47 100%);
    }

    .brand-link {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.05);
    }

    .brand-logo-custom {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #11760E, #1a8a12);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 22px;
        margin-left: 12px;
        box-shadow: 0 4px 15px rgba(17, 118, 14, 0.3);
    }

    .brand-text {
        color: white !important;
        font-size: 16px;
        font-weight: 700 !important;
    }

    .user-panel .image img {
        width: 45px;
        height: 45px;
        border: 2px solid #11760E;
    }

    .nav-sidebar .nav-link {
        color: rgba(255, 255, 255, 0.8);
        border-radius: 8px;
        margin: 4px 8px;
        transition: all 0.3s;
    }

    .nav-sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .nav-sidebar .nav-link.active {
        background: linear-gradient(135deg, #11760E, #1a8a12);
        color: white;
        box-shadow: 0 4px 15px rgba(17, 118, 14, 0.3);
    }

    .nav-sidebar .nav-treeview .nav-link {
        padding-right: 2rem;
    }

    .nav-header {
        color: rgba(255, 255, 255, 0.4);
        font-size: 11px;
        padding: 1rem 1rem 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .nav-sidebar .nav-link p {
        color: inherit;
    }
</style>
