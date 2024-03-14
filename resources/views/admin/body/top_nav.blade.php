

    @php 

use Carbon\Carbon;

$today = Carbon::now()->startOfDay(); // Get the start of the current day

$reminders = \App\Models\RequestProperty::whereDate('contact_datetime', '<=', $today)
    ->where('read', false)
    ->get();


        function fTime($contactDatetime) {
    $contactTime = Carbon::parse($contactDatetime)->locale('ar'); // تعيين اللغة للعربية

    if ($contactTime->isToday()) {
        if ($contactTime->hour < 12) { // التحقق من أن الوقت قبل الظهر
            return 'اليوم في ' . $contactTime->format('h:i صباحًا');
        } else {
            return 'اليوم في ' . $contactTime->format('h:i مساءً');
        }
    } elseif ($contactTime->isYesterday()) {
        if ($contactTime->hour < 12) { // التحقق من أن الوقت قبل الظهر
            return 'أمس في ' . $contactTime->format('h:i صباحًا');
        } else {
            return 'أمس في ' . $contactTime->format('h:i مساءً');
        }
    } else {
        if ($contactTime->hour < 12) { // التحقق من أن الوقت قبل الظهر
            return $contactTime->format('Y-m-d h:i صباحًا');
        } else {
            return $contactTime->format('Y-m-d h:i مساءً');
        }
    }
}







    @endphp




 

<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
  <!-- Left navbar links -->


  <!-- SEARCH FORM -->


  <!-- Right navbar links -->
  <ul class="navbar-nav mr-auto">
      <!-- Messages Dropdown Menu -->
   
      


         
      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell"></i>
            <span class="badge badge-success navbar-badge">{{ $reminders->where('read', false)->count() }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
            <span class="dropdown-item dropdown-header">{{ $reminders->where('read', false)->count() }} اشعار</span>
    
            @foreach($reminders as $reminder)
            <form action="{{ route('notification.markAsRead',$reminder->id) }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="far fa-bell"></i> 
                    <div class="notification-content">
                        <span>لديك اجتماع مع {{ $reminder->client_name }}</span>
                        <span>{{ fTime($reminder->contact_datetime) }}</span>
                        <span>{{ $reminder->time }}</span>
                    </div>
                </button>
            </form>
            <div class="dropdown-divider"></div>
        @endforeach
        
    
            <div class="dropdown-divider"></div>
            <a href="{{ route('notification.page') }}" class="dropdown-item dropdown-footer">عرض جميع الاشعارات</a>
        </div>
    </li>
    
    <style>
        .notification-content {
            display: flex;
            flex-direction: column;
        }
    </style>
    


  </ul>
</nav>