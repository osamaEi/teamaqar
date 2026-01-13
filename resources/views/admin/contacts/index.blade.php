@extends('admin.admin_master')
@section('title', 'إدارة العملاء')
@section('admin')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-users text-primary"></i> إدارة العملاء</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">العملاء</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
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

            {{-- Filter & Search Card --}}
            <div class="card card-outline card-primary mb-4">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-filter"></i> بحث وتصفية</h3>
                    <div class="card-tools">
                        <a href="{{ route('contacts.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> إضافة عميل جديد
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('contacts.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>بحث</label>
                                    <input type="text" name="search" class="form-control"
                                           placeholder="ابحث بالاسم أو الهاتف أو الإيميل..."
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نوع العميل</label>
                                    <select name="type" class="form-control">
                                        <option value="">الكل</option>
                                        @foreach($typeLabels as $key => $label)
                                            <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> بحث
                                        </button>
                                        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-redo"></i> إعادة تعيين
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ \App\Models\Client::count() }}</h3>
                            <p>إجمالي العملاء</p>
                        </div>
                        <div class="icon"><i class="fas fa-users"></i></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ \App\Models\Client::where('type', 'client')->count() }}</h3>
                            <p>العملاء</p>
                        </div>
                        <div class="icon"><i class="fas fa-user"></i></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ \App\Models\Client::where('type', 'owner')->count() }}</h3>
                            <p>الملاك</p>
                        </div>
                        <div class="icon"><i class="fas fa-home"></i></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ \App\Models\Client::where('type', 'investor')->count() }}</h3>
                            <p>المستثمرين</p>
                        </div>
                        <div class="icon"><i class="fas fa-chart-line"></i></div>
                    </div>
                </div>
            </div>

            {{-- Clients Table --}}
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list"></i> قائمة العملاء</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الهاتف</th>
                                <th>الإيميل</th>
                                <th>النوع</th>
                                <th>الشركة</th>
                                <th>تاريخ الإضافة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>
                                        <strong>{{ $client->name }}</strong>
                                    </td>
                                    <td>
                                        @if($client->phone)
                                            <a href="tel:{{ $client->phone }}" class="text-dark">
                                                <i class="fas fa-phone text-success"></i> {{ $client->phone }}
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($client->email)
                                            <a href="mailto:{{ $client->email }}" class="text-dark">
                                                <i class="fas fa-envelope text-primary"></i> {{ $client->email }}
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $typeColors = [
                                                'client' => 'primary',
                                                'owner' => 'success',
                                                'broker' => 'warning',
                                                'investor' => 'danger',
                                            ];
                                        @endphp
                                        <span class="badge badge-{{ $typeColors[$client->type] ?? 'secondary' }}">
                                            {{ $client->type_label }}
                                        </span>
                                    </td>
                                    <td>{{ $client->company ?? '-' }}</td>
                                    <td>{{ $client->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            {{-- WhatsApp --}}
                                            @if($client->phone)
                                                <a href="{{ route('contacts.send_offer', $client->id) }}"
                                                   class="btn btn-success btn-sm" title="إرسال عرض واتساب">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            @endif

                                            {{-- Email --}}
                                            @if($client->email)
                                                <a href="{{ route('contacts.send_offer', $client->id) }}"
                                                   class="btn btn-info btn-sm" title="إرسال عرض إيميل">
                                                    <i class="fas fa-envelope"></i>
                                                </a>
                                            @endif

                                            {{-- Edit --}}
                                            <a href="{{ route('contacts.edit', $client->id) }}"
                                               class="btn btn-warning btn-sm" title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('contacts.destroy', $client->id) }}"
                                                  method="POST" style="display:inline;"
                                                  onsubmit="return confirm('هل أنت متأكد من حذف هذا العميل؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="حذف">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">لا يوجد عملاء حتى الآن</p>
                                        <a href="{{ route('contacts.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> إضافة أول عميل
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($clients->hasPages())
                    <div class="card-footer">
                        {{ $clients->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>

@endsection
