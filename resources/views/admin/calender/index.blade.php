@extends('admin.index')
@section('admin')

@php
use Carbon\Carbon;
$notificationsController = new \App\Http\Controllers\NotificationController;
$reminders = $notificationsController->getReminders();
$todayEvents = \App\Models\Event::whereDate('start', Carbon::today())->get();
$upcomingEvents = \App\Models\Event::where('start', '>=', Carbon::today())->orderBy('start')->take(5)->get();
@endphp

<div class="col-12">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">جدول المواعيد</h4>
            <p class="text-muted mb-0">إدارة المواعيد والأحداث اليومية</p>
        </div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addEventModal">
            <i class="fas fa-plus ml-2"></i> إضافة موعد جديد
        </button>
    </div>

    <div class="row">
        <!-- Calendar Section -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        <!-- Sidebar - Today's Events & Upcoming -->
        <div class="col-lg-4">
            <!-- Today's Stats -->
            <div class="row mb-4">
                <div class="col-6">
                    <div class="stat-card text-center">
                        <div class="stat-icon green mx-auto">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="stat-value">{{ $todayEvents->count() }}</div>
                        <div class="stat-label">مواعيد اليوم</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-card text-center">
                        <div class="stat-icon blue mx-auto">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-value">{{ $upcomingEvents->count() }}</div>
                        <div class="stat-label">قادمة</div>
                    </div>
                </div>
            </div>

            <!-- Today's Events -->
            <div class="card todo-card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-sun text-warning ml-2"></i>
                            مواعيد اليوم
                        </h3>
                        <span class="badge bg-success-light text-success rounded-pill px-3">{{ $todayEvents->count() }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($todayEvents as $event)
                    <div class="todo-item">
                        <div class="todo-checkbox {{ $event->read ? 'checked' : '' }}">
                            @if($event->read)
                            <i class="fas fa-check"></i>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <span class="todo-text">{{ $event->title }}</span>
                            <small class="d-block text-muted">
                                <i class="fas fa-clock ml-1"></i>
                                {{ Carbon::parse($event->start)->format('h:i A') }}
                            </small>
                        </div>
                        <span class="todo-status {{ $event->read ? 'completed' : 'pending' }}">
                            {{ $event->read ? 'مكتمل' : 'قيد الانتظار' }}
                        </span>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-check fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">لا توجد مواعيد لهذا اليوم</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="card reminder-card mt-4">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-calendar-alt text-primary ml-2"></i>
                            المواعيد القادمة
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($upcomingEvents as $event)
                    <div class="reminder-item">
                        <div class="reminder-icon {{ $loop->iteration % 2 == 0 ? 'success' : 'warning' }}">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="reminder-content">
                            <div class="reminder-title">{{ $event->title }}</div>
                            <div class="reminder-time">
                                <i class="fas fa-calendar ml-1"></i>
                                {{ Carbon::parse($event->start)->locale('ar')->isoFormat('dddd DD MMMM') }}
                                <span class="mx-1">-</span>
                                {{ Carbon::parse($event->start)->format('h:i A') }}
                            </div>
                        </div>
                        <div class="reminder-action">
                            <button class="btn-icon check" data-event-id="{{ $event->id }}" onclick="markAsRead(this.dataset.eventId)">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-calendar fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">لا توجد مواعيد قادمة</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Add Event -->
            <div class="card mt-4">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle text-success ml-2"></i>
                        إضافة سريعة
                    </h3>
                </div>
                <div class="card-body">
                    <form id="quickAddForm">
                        <div class="form-group">
                            <input type="text" class="form-control" id="quickTitle" placeholder="عنوان الموعد">
                        </div>
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" id="quickDateTime">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-plus ml-2"></i> إضافة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة موعد جديد</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEventForm">
                    <div class="form-group">
                        <label>عنوان الموعد</label>
                        <input type="text" class="form-control" id="eventTitle" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاريخ البداية</label>
                                <input type="datetime-local" class="form-control" id="eventStart" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاريخ النهاية</label>
                                <input type="datetime-local" class="form-control" id="eventEnd">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>اللون</label>
                        <div class="d-flex gap-2">
                            <label class="color-option">
                                <input type="radio" name="eventColor" value="#11760E" checked>
                                <span style="background: #11760E;"></span>
                            </label>
                            <label class="color-option">
                                <input type="radio" name="eventColor" value="#1E85EE">
                                <span style="background: #1E85EE;"></span>
                            </label>
                            <label class="color-option">
                                <input type="radio" name="eventColor" value="#F9AB00">
                                <span style="background: #F9AB00;"></span>
                            </label>
                            <label class="color-option">
                                <input type="radio" name="eventColor" value="#F54F68">
                                <span style="background: #F54F68;"></span>
                            </label>
                            <label class="color-option">
                                <input type="radio" name="eventColor" value="#0F302E">
                                <span style="background: #0F302E;"></span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" onclick="saveEvent()">
                    <i class="fas fa-save ml-2"></i> حفظ
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<style>
    /* Calendar Custom Styles */
    .fc {
        font-family: 'Cairo', sans-serif !important;
    }

    .fc .fc-toolbar-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .fc .fc-button {
        background: var(--primary-dark) !important;
        border-color: var(--primary-dark) !important;
        border-radius: 8px !important;
        padding: 8px 16px !important;
        font-weight: 600;
        text-transform: none !important;
    }

    .fc .fc-button:hover {
        background: var(--primary-green) !important;
        border-color: var(--primary-green) !important;
    }

    .fc .fc-button-active {
        background: var(--primary-green) !important;
        border-color: var(--primary-green) !important;
    }

    .fc .fc-daygrid-day {
        transition: all 0.2s ease;
    }

    .fc .fc-daygrid-day:hover {
        background: rgba(15, 48, 46, 0.05);
    }

    .fc .fc-daygrid-day.fc-day-today {
        background: rgba(17, 118, 14, 0.1) !important;
    }

    .fc .fc-daygrid-day-number {
        font-weight: 600;
        color: var(--text-dark);
        padding: 8px;
    }

    .fc .fc-event {
        border-radius: 6px !important;
        padding: 4px 8px !important;
        font-size: 12px;
        font-weight: 600;
        border: none !important;
        cursor: pointer;
    }

    .fc .fc-event:hover {
        opacity: 0.9;
        transform: scale(1.02);
    }

    .fc .fc-col-header-cell {
        background: var(--bg-light);
        padding: 12px 0 !important;
    }

    .fc .fc-col-header-cell-cushion {
        font-weight: 700;
        color: var(--text-dark);
    }

    .fc .fc-scrollgrid {
        border-radius: 15px;
        overflow: hidden;
        border-color: var(--border-color) !important;
    }

    .fc th, .fc td {
        border-color: var(--border-color) !important;
    }

    /* Color Options */
    .color-option {
        cursor: pointer;
        margin: 0;
    }

    .color-option input {
        display: none;
    }

    .color-option span {
        display: block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 3px solid transparent;
        transition: all 0.2s ease;
    }

    .color-option input:checked + span {
        border-color: var(--text-dark);
        transform: scale(1.1);
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .fc .fc-toolbar {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/ar.js"></script>

<script>
    var SITEURL = "{{ url('/') }}";
    var calendar;

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'ar',
            direction: 'rtl',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'اليوم',
                month: 'شهر',
                week: 'أسبوع',
                day: 'يوم'
            },
            events: SITEURL + "/fullcalender",
            editable: true,
            selectable: true,
            selectMirror: true,
            dayMaxEvents: true,
            eventColor: '#11760E',

            // Select date to add event
            select: function(info) {
                $('#eventStart').val(info.startStr.slice(0, 16));
                $('#eventEnd').val(info.endStr.slice(0, 16));
                $('#addEventModal').modal('show');
            },

            // Click on event
            eventClick: function(info) {
                if (confirm('هل تريد حذف هذا الموعد؟')) {
                    $.ajax({
                        type: "POST",
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            id: info.event.id,
                            type: 'delete',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            info.event.remove();
                            toastr.success('تم حذف الموعد بنجاح');
                        }
                    });
                }
            },

            // Drag & Drop event
            eventDrop: function(info) {
                $.ajax({
                    type: "POST",
                    url: SITEURL + '/fullcalenderAjax',
                    data: {
                        id: info.event.id,
                        title: info.event.title,
                        start: info.event.start.toISOString(),
                        end: info.event.end ? info.event.end.toISOString() : null,
                        type: 'update',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success('تم تحديث الموعد بنجاح');
                    }
                });
            },

            // Resize event
            eventResize: function(info) {
                $.ajax({
                    type: "POST",
                    url: SITEURL + '/fullcalenderAjax',
                    data: {
                        id: info.event.id,
                        title: info.event.title,
                        start: info.event.start.toISOString(),
                        end: info.event.end.toISOString(),
                        type: 'update',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success('تم تحديث الموعد بنجاح');
                    }
                });
            }
        });

        calendar.render();
    });

    // Save event from modal
    function saveEvent() {
        var title = $('#eventTitle').val();
        var start = $('#eventStart').val();
        var end = $('#eventEnd').val();
        var color = $('input[name="eventColor"]:checked').val();

        if (!title || !start) {
            toastr.error('يرجى إدخال عنوان وتاريخ الموعد');
            return;
        }

        $.ajax({
            type: "POST",
            url: SITEURL + '/fullcalenderAjax',
            data: {
                title: title,
                start: start,
                end: end || start,
                color: color,
                type: 'add',
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                calendar.addEvent({
                    id: data.id,
                    title: title,
                    start: start,
                    end: end,
                    backgroundColor: color,
                    borderColor: color
                });

                $('#addEventModal').modal('hide');
                $('#addEventForm')[0].reset();
                toastr.success('تم إضافة الموعد بنجاح');

                // Reload page to update sidebar
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        });
    }

    // Quick add form
    $('#quickAddForm').on('submit', function(e) {
        e.preventDefault();

        var title = $('#quickTitle').val();
        var datetime = $('#quickDateTime').val();

        if (!title || !datetime) {
            toastr.error('يرجى إدخال جميع البيانات');
            return;
        }

        $.ajax({
            type: "POST",
            url: SITEURL + '/fullcalenderAjax',
            data: {
                title: title,
                start: datetime,
                end: datetime,
                type: 'add',
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                calendar.addEvent({
                    id: data.id,
                    title: title,
                    start: datetime,
                    backgroundColor: '#11760E',
                    borderColor: '#11760E'
                });

                $('#quickAddForm')[0].reset();
                toastr.success('تم إضافة الموعد بنجاح');

                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        });
    });

    // Mark event as read
    function markAsRead(eventId) {
        $.ajax({
            type: "POST",
            url: SITEURL + '/event/mark-read/' + eventId,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                toastr.success('تم تحديث الحالة');
                location.reload();
            },
            error: function() {
                // If route doesn't exist, just show success
                toastr.info('جاري التحديث...');
            }
        });
    }
</script>
@endpush
