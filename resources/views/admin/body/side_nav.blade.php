

  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: rgb(87, 119, 87)">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">لوحة التحكم</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel (optional) -->
            

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
                          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    {{ __('Dashboard')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                 
                  <li class="nav-item">
                    <a href="{{ route('dashboard.page')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> {{ __('Analysis')}}</p>
                    </a>
                  </li>
               
                </ul>
              </li>
       
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               {{ __('Properties')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="{{ route('property.create.page')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{ __('Add New Offer')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('properties.page')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{ __('Lists')}}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                {{ __('Requests')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="{{ route('requests.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{ __('Add New Requests')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('requests.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{ __('Lists')}}</p>
                </a>
              </li>
            </ul>
          </li>

  
        </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>