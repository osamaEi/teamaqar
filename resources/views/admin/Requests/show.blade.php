@extends('admin.index')
@section('admin') 


<div class="table-responsive">
    <table class="table table-hover">       
      

        <tr>
            <th style="font-size: 15px; color: dodgerblue;"><b>{{ __('Client Name')}}</b></th>
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
            <th><b>{{ __('Request ')}}</b></th>
            <td colspan="3">{{ $request->request_name}}</td>
        </tr>
        <tr>
            <th><b>{{ __('situation')}}</b></th>
            <td colspan="3">{{ $request->traking_client}}</td>
        </tr>
        <tr>
            <th><b>{{ __('date')}}</b></th>
            <td colspan="3">    {{ \Carbon\Carbon::parse($request->contact_datetime)->format('d-m-Y h:i A') }}</td>
        </tr>
  
    </table>
</div>



@endsection