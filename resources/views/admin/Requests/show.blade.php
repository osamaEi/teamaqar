@extends('admin.index')
@section('admin') 


<div class="table-responsive">
    <table class="table table-hover">       
      

        <tr>
            <th style="font-size: 15px; color: dodgerblue;"><b>{{ __('أسم العميل')}}</b></th>
            <td colspan="3">{{$request->client_name}}</td>
        </tr>
      
        <tr>
            <th><b>{{ __('Phone')}}</b></th>
            <td colspan="3">{{ $request->client_phone}}</td>
        </tr>
        <tr>
            <th><b>{{ __('Status')}}</b></th>
            <td colspan="3">{{ $request->client_type}}</td>
        </tr>
        <tr>
            <th><b>{{ __('الطلب ')}}</b></th>
            <td colspan="3">{{ $request->request_name}}</td>
        </tr>

        <tr>
            <th><b>{{ __('طلب أخر ')}}</b></th>
            <td colspan="3">{{ $request->other_request}}</td>
        </tr>
        <tr>
            <th><b>{{ __('المتابعة')}}</b></th>
            <td colspan="3">{{ $request->traking_client}}</td>
        </tr>
        <tr>
            <th><b>{{ __('معاد المقابلة')}}</b></th>
            <td colspan="3">     @php 
                $event = \App\Models\Event::where('request_id', $request->id)->first();
            @endphp
           
              @if($event && isset($event->start))
                  {{ \Carbon\Carbon::parse($event->start)->locale('ar')->isoFormat('dddd DD/MM الساعة h a') }}
              @else
                  لم يتم تحديد وقت
              @endif</td>
        </tr>
  
    </table>
</div>



@endsection