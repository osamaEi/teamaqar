<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wasset</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
</head>
<body class="hold-transition sidebar-mini" dir="rtl">
<div class="wrapper">
    <!-- Navbar -->


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
    
                            <span>لديك اجتماع اليوم مع الساعة  {{ $reminder->title }}</span>
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
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
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
        <!-- /.navbar -->
    @include('admin.body.side_nav')
    <!-- Main Sidebar Container -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div id='calendar'></div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
                    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

                    <style>


.toast-success {
    background-color: skyblue ; /* Set the background color to light green */
}
                    </style>
                    <script>
                        $(document).ready(function () {
                            var SITEURL = "{{ url('/') }}";
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            var calendar = $('#calendar').fullCalendar({
                                editable: true,
                                events: SITEURL + "/fullcalender",
                                displayEventTime: true,
                                header: {
                                    left: 'prev,next today',
                                    center: 'title',
                                    right: 'month,agendaWeek,agendaDay',
                                    backgroundColor: 'green' // Set the background color to green

                                },
                                eventRender: function (event, element, view) {
                                    if (event.allDay === 'true') {
                                        event.allDay = true;
                                    } else {
                                        event.allDay = false;
                                    }
                                },
                                selectable: true,
                                selectHelper: true,
                                select: function (start, end, allDay) {
                                    var title = prompt('عنوان الحدث:');
                                    if (title) {
                                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                                        $.ajax({
                                            url: SITEURL + "/fullcalenderAjax",
                                            data: {
                                                title: title,
                                                start: start,
                                                end: end,
                                                type: 'add'
                                            },
                                            type: "POST",
                                            success: function (data) {
    displayMessage("تم إنشاء الموعد بنجاح");
    calendar.fullCalendar('renderEvent', {
        id: data.id,
        title: title,
        start: start,
        end: end,
        allDay: allDay,
        backgroundColor: 'green' // Set the background color to green
    }, true);
    calendar.fullCalendar('unselect');
}

                                        });
                                    }
                                },
                                eventDrop: function (event, delta) {
                                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                                    $.ajax({
                                        url: SITEURL + '/fullcalenderAjax',
                                        data: {
                                            title: event.title,
                                            start: start,
                                            end: end,
                                            id: event.id,
                                            type: 'update'
                                        },
                                        type: "POST",
                                        success: function (response) {
                                            displayMessage("تم تحديث الحدث بنجاح");
                                        }
                                    });
                                },
                                eventClick: function (event) {
                                    var deleteMsg = confirm("هل تريد مسح الموعد ؟");
                                    if (deleteMsg) {
                                        $.ajax({
                                            type: "POST",
                                            url: SITEURL + '/fullcalenderAjax',
                                            data: {
                                                id: event.id,
                                                type: 'delete'
                                            },
                                            success: function (response) {
                                                calendar.fullCalendar('removeEvents', event.id);
                                                displayMessage("تم حذف الحدث بنجاح");
                                            }
                                        });
                                    }
                                }
                            });
                        });
                        function displayMessage(message) {
    toastr.options = {
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "progressBar": true,
        "background-color": "#d4edda", // Set the background color to light green
        "iconClasses": {
            "success": "toast-success"
        }
    };
    
    
    toastr.success(message, 'حدث');
}
$('#calendar').on('click touchstart', function (event) {
        // Prevent the default action
        event.preventDefault();
        // Get the clicked/touched coordinates
        var coords = event.originalEvent.touches ? event.originalEvent.touches[0] : event;
        // Determine the clicked/touched date
        var date = calendar.fullCalendar('getDateFromElement', $(this), coords);
        // Open the event creation prompt
        handleEventCreation(date, date, true); // Pass the same start and end date for simplicity
    });
                    </script>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

    
   
    <!-- jQuery Knob Chart -->

    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('dist/js/adminlte.js')}}"></script>
</div> <!-- .wrapper -->
</body>
</html>
