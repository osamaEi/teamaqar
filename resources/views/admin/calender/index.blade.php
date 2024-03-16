<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>دورة Laravel Fullcalendar - ItSolutionStuff.com</title>
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
    @include('admin.body.top_nav')
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
                                    right: 'month,agendaWeek,agendaDay'
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
                                                displayMessage("تم إنشاء الحدث بنجاح");
                                                calendar.fullCalendar('renderEvent', {
                                                    id: data.id,
                                                    title: title,
                                                    start: start,
                                                    end: end,
                                                    allDay: allDay
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
                       
                    </script>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
    <!-- Main Footer -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
</div> <!-- .wrapper -->
</body>
</html>
