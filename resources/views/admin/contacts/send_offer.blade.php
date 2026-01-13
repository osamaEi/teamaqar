@extends('admin.index')
@section('title', 'إرسال عرض للعميل')
@section('admin')

<div class="col-12">
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-paper-plane text-primary"></i> إرسال عرض للعميل</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.page') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">العملاء</a></li>
                    <li class="breadcrumb-item active">إرسال عرض</li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="row">
        {{-- Client Info --}}
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user"></i> بيانات العميل</h3>
                </div>
                <div class="card-body text-center">
                    @php
                        $typeColors = [
                            'client' => 'primary',
                            'owner' => 'success',
                            'broker' => 'warning',
                            'investor' => 'danger',
                        ];
                        $typeIcons = [
                            'client' => 'fa-user',
                            'owner' => 'fa-home',
                            'broker' => 'fa-handshake',
                            'investor' => 'fa-chart-line',
                        ];
                    @endphp
                    <div class="bg-{{ $typeColors[$client->type] ?? 'secondary' }} rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas {{ $typeIcons[$client->type] ?? 'fa-user' }} fa-2x text-white"></i>
                    </div>
                    <h4>{{ $client->name }}</h4>
                    <span class="badge badge-{{ $typeColors[$client->type] ?? 'secondary' }}">
                        {{ $client->type_label }}
                    </span>

                    <hr>

                    <div class="text-right">
                        @if($client->phone)
                            <p class="mb-2">
                                <i class="fas fa-phone text-success"></i>
                                <a href="tel:{{ $client->phone }}">{{ $client->phone }}</a>
                            </p>
                        @endif
                        @if($client->email)
                            <p class="mb-2">
                                <i class="fas fa-envelope text-primary"></i>
                                <a href="mailto:{{ $client->email }}">{{ $client->email }}</a>
                            </p>
                        @endif
                        @if($client->company)
                            <p class="mb-2">
                                <i class="fas fa-building text-muted"></i>
                                {{ $client->company }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Send Offer Form --}}
        <div class="col-md-8">
            {{-- WhatsApp Card --}}
            <div class="card card-success card-outline mb-4">
                <div class="card-header">
                    <h3 class="card-title"><i class="fab fa-whatsapp"></i> إرسال عبر الواتساب</h3>
                </div>
                <form action="{{ route('contacts.send_whatsapp', $client->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if(!$client->phone)
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                هذا العميل ليس لديه رقم جوال مسجل
                            </div>
                        @endif

                        <div class="form-group">
                            <label><i class="fas fa-home"></i> اختر العقار للعرض</label>
                            <select name="property_id" class="form-control select2" {{ !$client->phone ? 'disabled' : '' }} required>
                                <option value="">-- اختر عقار --</option>
                                @foreach($properties as $property)
                                    <option value="{{ $property->id }}">
                                        {{ $property->name ?? 'عقار #'.$property->id }} -
                                        {{ $property->Location }} -
                                        {{ $property->price }} ريال
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-comment"></i> رسالة إضافية (اختياري)</label>
                            <textarea name="custom_message" class="form-control" rows="3"
                                      placeholder="أضف رسالة مخصصة للعميل..."
                                      {{ !$client->phone ? 'disabled' : '' }}></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success" {{ !$client->phone ? 'disabled' : '' }}>
                            <i class="fab fa-whatsapp"></i> إرسال للواتساب
                        </button>
                    </div>
                </form>
            </div>

            {{-- Email Card --}}
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-envelope"></i> إرسال عبر البريد الإلكتروني</h3>
                </div>
                <form action="{{ route('contacts.send_email', $client->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if(!$client->email)
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                هذا العميل ليس لديه بريد إلكتروني مسجل
                            </div>
                        @endif

                        <div class="form-group">
                            <label><i class="fas fa-heading"></i> عنوان الرسالة</label>
                            <input type="text" name="subject" class="form-control"
                                   placeholder="عرض خاص من أبو نواف للعقارات"
                                   value="عرض خاص من أبو نواف للعقارات"
                                   {{ !$client->email ? 'disabled' : '' }} required>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-home"></i> اختر العقار للعرض</label>
                            <select name="property_id" class="form-control select2" {{ !$client->email ? 'disabled' : '' }} required>
                                <option value="">-- اختر عقار --</option>
                                @foreach($properties as $property)
                                    <option value="{{ $property->id }}">
                                        {{ $property->name ?? 'عقار #'.$property->id }} -
                                        {{ $property->Location }} -
                                        {{ $property->price }} ريال
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-comment"></i> رسالة إضافية (اختياري)</label>
                            <textarea name="custom_message" class="form-control" rows="3"
                                      placeholder="أضف رسالة مخصصة للعميل..."
                                      {{ !$client->email ? 'disabled' : '' }}></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info" {{ !$client->email ? 'disabled' : '' }}>
                            <i class="fas fa-paper-plane"></i> إرسال للبريد الإلكتروني
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Quick Send to Multiple Clients --}}
    <div class="card card-warning card-outline mt-4">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-users"></i> إرسال سريع لعدة عملاء</h3>
        </div>
        <div class="card-body">
            <p class="text-muted">
                يمكنك إرسال نفس العرض لعدة عملاء من خلال العودة لقائمة العملاء واختيار العملاء المطلوبين.
            </p>
            <a href="{{ route('contacts.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-right"></i> العودة لقائمة العملاء
            </a>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: '-- اختر عقار --',
            allowClear: true
        });
    });
</script>
@endsection
