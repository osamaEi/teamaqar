
@if (Auth::check())

<aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.page') }}" class="brand-link">
        <div class="brand-logo-custom">
            <i class="fas fa-home"></i>
        </div>
        <span class="brand-text font-weight-light">abun3w3f</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white">{{ Auth::user()->name }}</a>
                <small class="text-white-50">مدير النظام</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            لوحة التحكم
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.page') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>التحليلات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('calender.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>جدول اليوم</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Properties -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            العقارات
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('properties.page') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>قائمة العقارات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('property.create.page') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>إضافة عقار</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('property.createdraw') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>إضافة بالرسم</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('property.map') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>خريطة العقارات</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Requests -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            الطلبات
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('requests.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>قائمة الطلبات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('requests.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>إضافة طلب</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- Contacts/Clients -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            العملاء
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('contacts.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>قائمة العملاء</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contacts.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>إضافة عميل</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Mediators -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            الموظفين
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>قائمة الموظفين</p>
                            </a>
                        </li>
                    </ul>
                </li>

          

                <!-- ToDo -->
                <li class="nav-item">
                    <a href="{{ route('todo.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>المهام</p>
                    </a>
                </li>

                <!-- Files -->
                <li class="nav-item">
                    <a href="{{ route('files.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>الملفات</p>
                    </a>
                </li>

                <!-- Map -->
                <li class="nav-item">
                    <a href="{{ route('property.map') }}" class="nav-link">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>الخريطة</p>
                    </a>
                </li>

                <!-- Notifications -->
                <li class="nav-item">
                    <a href="{{ route('notification.page') }}" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>الاشعارات</p>
                    </a>
                </li>

                <!-- Settings -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>الاعدادات</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

@else

<aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <div class="brand-logo-custom">
            <i class="fas fa-home"></i>
        </div>
        <span class="brand-text font-weight-light">الوسيط للعقارات</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Properties -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            العقارات
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('clients.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>قائمة العقارات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('property.map') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>خريطة العقارات</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>

@endif
