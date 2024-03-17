@extends('admin.index')

@section('admin')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('شكرا على تقديم طلبك سنتواصل معك قريبا') }}</div>

                <div class="card-body">
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="btn btn-primary">{{ __('الصفحة الرئيسية') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
