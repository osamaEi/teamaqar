@extends('user.layouts.app')
@section('title', 'لوحة التحكم')
@section('content')

<div class="col-12">
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-tachometer-alt text-primary"></i> لوحة التحكم</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">لوحة التحكم</li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total'] }}</h3>
                    <p>إجمالي العقارات</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="{{ route('user.dashboard') }}" class="small-box-footer">
                    المزيد <i class="fas fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['available'] }}</h3>
                    <p>عقارات متاحة</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <a href="{{ route('user.dashboard') }}" class="small-box-footer">
                    المزيد <i class="fas fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['sold'] }}</h3>
                    <p>عقارات مباعة</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <a href="{{ route('user.dashboard') }}" class="small-box-footer">
                    المزيد <i class="fas fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stats['reserved'] }}</h3>
                    <p>عقارات محجوزة</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bookmark"></i>
                </div>
                <a href="{{ route('user.dashboard') }}" class="small-box-footer">
                    المزيد <i class="fas fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Properties List --}}
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-list"></i> عقاراتي</h3>
            <div class="card-tools">
                <a href="{{ route('user.properties.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> إضافة عقار جديد
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($properties->count() > 0)
                <div class="row">
                    @foreach($properties as $property)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="card h-100">
                                @if($property->image)
                                    <img src="{{ asset($property->image) }}" alt="{{ $property->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-home" style="font-size: 60px; color: white;"></i>
                                    </div>
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $property->name ?? 'عقار #' . $property->id }}</h5>

                                    <div class="mb-2">
                                        @if($property->location)
                                            <small class="text-muted">
                                                <i class="fas fa-map-marker-alt text-danger"></i> {{ $property->location }}
                                            </small>
                                            <br>
                                        @endif
                                        @if($property->area)
                                            <small class="text-muted">
                                                <i class="fas fa-ruler-combined text-info"></i> {{ $property->area }}
                                            </small>
                                            <br>
                                        @endif
                                        @if($property->price)
                                            <small class="text-muted">
                                                <i class="fas fa-dollar-sign text-success"></i> {{ number_format($property->price) }} ريال
                                            </small>
                                        @endif
                                    </div>

                                    @php
                                        $statusClass = match($property->status) {
                                            'Available' => 'success',
                                            'Sold' => 'warning',
                                            'Reserved' => 'danger',
                                            default => 'secondary'
                                        };
                                        $statusText = match($property->status) {
                                            'Available' => 'متاح',
                                            'Sold' => 'مباع',
                                            'Reserved' => 'محجوز',
                                            default => 'غير محدد'
                                        };
                                    @endphp

                                    <span class="badge badge-{{ $statusClass }}">{{ $statusText }}</span>
                                </div>

                                <div class="card-footer">
                                    <div class="btn-group d-flex" role="group">
                                        <a href="{{ route('user.properties.show', $property->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> عرض
                                        </a>
                                        <a href="{{ route('user.properties.edit', $property->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> تعديل
                                        </a>
                                        <form action="{{ route('user.properties.destroy', $property->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('هل أنت متأكد من حذف هذا العقار؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $properties->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-home fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted">لا توجد عقارات حتى الآن</h4>
                    <p class="text-muted mb-4">ابدأ بإضافة أول عقار لك</p>
                    <a href="{{ route('user.properties.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> إضافة عقار جديد
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
