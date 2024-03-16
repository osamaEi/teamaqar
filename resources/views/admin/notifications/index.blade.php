@extends('admin.index')

@section('admin') 
    <div class="container-fluid">
        <h3 class="mt-4">{{ __('Notifications')}}</h3>
        <hr>

        @php 

use Carbon\Carbon;

$today = Carbon::now()->startOfDay(); // Get the start of the current day

$reminders = \App\Models\Event::whereDate('start', '<=', $today)
    ->where('read', false)
    ->get();


    
    function formatTime($contactDatetime) {
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

<div class="row">
    <div class="col-lg-12">
        @if($reminders->count()>0)
            <div class="list-group">
                @foreach($reminders as $reminder)
                    <form action="{{ route('notification.markAsRead',$reminder->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link">
                            <i class="far fa-check-circle"></i> {{ __('Mark as Read')}}
                        </button>
                    </form>
                    <a href="" class="list-group-item list-group-item-action">
                        <i class="far fa-bell"></i>   لديك اجتماع مع {{ $reminder->client_name }} {{ formatTime($reminder->contact_datetime) }}        


                        <span class="float-right text-muted text-sm">{{ $reminder->time }}</span>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-muted">No notifications</p>
        @endif
    </div>
</div>

    </div>

 
 
 
 
 
    

@endsection
