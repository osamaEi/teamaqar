@extends('admin.admin_master')
@section('title', 'تعديل بيانات العميل')
@section('admin')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-edit text-primary"></i> تعديل بيانات العميل</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.page') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">العملاء</a></li>
                        <li class="breadcrumb-item active">تعديل</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-info-circle"></i> بيانات العميل</h3>
                        </div>
                        <form action="{{ route('contacts.update', $client->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                {{-- Validation Errors --}}
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><i class="fas fa-user"></i> الاسم <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name', $client->name) }}" required
                                                   placeholder="أدخل اسم العميل">
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type"><i class="fas fa-tag"></i> نوع العميل <span class="text-danger">*</span></label>
                                            <select name="type" id="type"
                                                    class="form-control @error('type') is-invalid @enderror" required>
                                                @foreach($typeLabels as $key => $label)
                                                    <option value="{{ $key }}" {{ old('type', $client->type) == $key ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone"><i class="fas fa-phone"></i> رقم الجوال</label>
                                            <input type="text" name="phone" id="phone"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   value="{{ old('phone', $client->phone) }}"
                                                   placeholder="05XXXXXXXX">
                                            @error('phone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email"><i class="fas fa-envelope"></i> البريد الإلكتروني</label>
                                            <input type="email" name="email" id="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email', $client->email) }}"
                                                   placeholder="example@email.com">
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company"><i class="fas fa-building"></i> الشركة</label>
                                            <input type="text" name="company" id="company"
                                                   class="form-control @error('company') is-invalid @enderror"
                                                   value="{{ old('company', $client->company) }}"
                                                   placeholder="اسم الشركة (اختياري)">
                                            @error('company')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address"><i class="fas fa-map-marker-alt"></i> العنوان</label>
                                            <input type="text" name="address" id="address"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   value="{{ old('address', $client->address) }}"
                                                   placeholder="العنوان (اختياري)">
                                            @error('address')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="notes"><i class="fas fa-sticky-note"></i> ملاحظات</label>
                                    <textarea name="notes" id="notes" rows="3"
                                              class="form-control @error('notes') is-invalid @enderror"
                                              placeholder="أي ملاحظات إضافية عن العميل...">{{ old('notes', $client->notes) }}</textarea>
                                    @error('notes')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> حفظ التعديلات
                                </button>
                                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> إلغاء
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Client Info Card --}}
                <div class="col-md-4">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user-circle"></i> معلومات العميل</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-3">
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
                                <div class="bg-{{ $typeColors[$client->type] ?? 'secondary' }} rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="fas {{ $typeIcons[$client->type] ?? 'fa-user' }} fa-2x text-white"></i>
                                </div>
                            </div>
                            <h4>{{ $client->name }}</h4>
                            <span class="badge badge-{{ $typeColors[$client->type] ?? 'secondary' }} mb-3">
                                {{ $client->type_label }}
                            </span>

                            <hr>

                            <div class="text-right">
                                <p class="mb-2">
                                    <i class="fas fa-calendar text-muted"></i>
                                    تاريخ الإضافة: {{ $client->created_at->format('Y-m-d') }}
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-clock text-muted"></i>
                                    آخر تحديث: {{ $client->updated_at->format('Y-m-d') }}
                                </p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('contacts.send_offer', $client->id) }}" class="btn btn-success btn-block">
                                <i class="fab fa-whatsapp"></i> إرسال عرض
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
