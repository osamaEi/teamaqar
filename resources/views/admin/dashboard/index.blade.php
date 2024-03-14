@extends('admin.index')
@section('admin') 


@php

$propertyCount = \App\Models\Property::count();

$requestCount = \App\Models\RequestProperty::count();


use Carbon\Carbon;

$today = Carbon::now()->startOfDay();
$remindersTodayCount = \App\Models\RequestProperty::whereDate('contact_datetime', '=', $today)
    ->where('read', false)
    ->count();


$allreminders =\App\Models\RequestProperty::where('read', false)
    ->count();


 $mediator1Count = \App\Models\Property::whereNotNull('mediator1')->distinct('mediator1')->count('mediator1');
$mediator2Count = \App\Models\Property::whereNotNull('mediator2')->distinct('mediator2')->count('mediator2');

@endphp


    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$propertyCount}}</h3>


          <p>العروض العقارية</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{$requestCount}}</h3>

          <p>الطلبات العقارية</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{$requestCount}}</h3>

          <p>عدد العملاء</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{$remindersTodayCount}}</h3>

          <p>المهام اليومية</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{$allreminders}}</h3>

          <p>عدد المواعيد</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div>



    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{$mediator1Count + $mediator2Count}}</h3>

          <p>عدد الوسطاء</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div>

    

  @endsection