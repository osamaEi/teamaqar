@extends('admin.admin_master')
@section('title', 'إضافة عميل جديد')
@section('admin')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-plus text-primary"></i> إضافة عميل جديد</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.page') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">العملاء</a></li>
                        <li class="breadcrumb-item active">إضافة عميل</li>
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
                        <form action="{{ route('contacts.store') }}" method="POST">
                            @csrf
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
                                                   value="{{ old('name') }}" required
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
                                                    <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
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
                                                   value="{{ old('phone') }}"
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
                                                   value="{{ old('email') }}"
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
                                                   value="{{ old('company') }}"
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
                                                   value="{{ old('address') }}"
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
                                              placeholder="أي ملاحظات إضافية عن العميل...">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> حفظ العميل
                                </button>
                                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> إلغاء
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Side Info --}}
                <div class="col-md-4">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-lightbulb"></i> أنواع العملاء</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge badge-primary mr-2 p-2"><i class="fas fa-user"></i></span>
                                <div>
                                    <strong>عميل</strong>
                                    <br><small class="text-muted">شخص يبحث عن عقار للشراء أو الإيجار</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge badge-success mr-2 p-2"><i class="fas fa-home"></i></span>
                                <div>
                                    <strong>مالك</strong>
                                    <br><small class="text-muted">شخص يملك عقار ويريد بيعه أو تأجيره</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge badge-warning mr-2 p-2"><i class="fas fa-handshake"></i></span>
                                <div>
                                    <strong>وسيط</strong>
                                    <br><small class="text-muted">وسيط عقاري للتعاون والشراكة</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-danger mr-2 p-2"><i class="fas fa-chart-line"></i></span>
                                <div>
                                    <strong>مستثمر</strong>
                                    <br><small class="text-muted">شخص يبحث عن فرص استثمارية</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
