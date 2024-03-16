

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
   
    </ul>

  
 
<ul class="navbar-nav mr-auto-navbav">
 
   
    @php
    $notificationsController = new \App\Http\Controllers\NotificationController;
    $reminders = $notificationsController->getReminders();
@endphp

      
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell"></i>
            <span class="badge badge-success navbar-badge">{{ $reminders->where('read', false)->count() }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="  margin-left: -102px;
        min-width: 23rem;">
            <span class="dropdown-item dropdown-header">{{ $reminders->where('read', false)->count() }} اشعار</span>
    
            @foreach($reminders as $reminder)
            <form action="" method="">
                <button type="submit" class="dropdown-item">
                    <div class="notification-content">
                        <i class="far fa-bell"></i> 

                        <span>لديك اجتماع اليوم مع   {{ $reminder->title }}</span>
                    </div>
                </button>
            </form>
            <div class="dropdown-divider"></div>
            @endforeach

            <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
              </a>
              <div class="dropdown-divider"></div>
    
        
    
            <div class="dropdown-divider"></div>
            <a href="{{ route('notification.page') }}" class="dropdown-item dropdown-footer">عرض جميع الاشعارات</a>
        </div>
    </li>
  

      
              <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
<span>{{Auth::user()->name}}<br>
</span>          
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item d-flex align-items-right" href="{{ route('employee.logout') }}"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
    
       
        </div>
      </li>
  </ul>
</nav>
