@extends('admin.index')

@section('admin') 
    <div class="container-fluid">
        <h3 class="mt-4">{{ __('Notifications')}}</h3>
        <hr>

        @php 

use Carbon\Carbon;

$today = Carbon::now()->startOfDay(); // Get the start of the current day

$reminders = \App\Models\RequestProperty::whereDate('contact_datetime', '<=', $today)
    ->where('read', false)
    ->get();


    
    function formatTime($contactDatetime) {
    $contactTime = Carbon::parse($contactDatetime);

    if ($contactTime->isToday()) {
        return 'today at ' . $contactTime->format('h:i A');
    } elseif ($contactTime->isYesterday()) {
        return 'yesterday at ' . $contactTime->format('h:i A');
    } else {
        return $contactTime->format('Y-m-d h:i A');
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
                        <i class="far fa-bell"></i>   You have a meeting with {{ $reminder->client_name }} {{ formatTime($reminder->contact_datetime) }}        


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
