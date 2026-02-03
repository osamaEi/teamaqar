@extends('admin.index')
@section('admin')

<style>
    :root {
        --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --gradient-4: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        --gradient-5: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }

    .file-manager-header {
        background: var(--gradient-1);
        color: white;
        padding: 40px 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .file-manager-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }

    .file-stats {
        display: flex;
        gap: 30px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .stat-item i {
        font-size: 24px;
        opacity: 0.9;
    }

    .stat-item span {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .upload-section {
        background: var(--gradient-2);
        color: white;
        padding: 40px;
        border-radius: 15px;
        text-align: center;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-section:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(245, 87, 108, 0.4);
    }

    .upload-section i {
        font-size: 48px;
        margin-bottom: 15px;
        display: block;
    }

    .upload-section h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .upload-section p {
        opacity: 0.9;
        margin: 0;
    }

    .search-wrapper {
        margin-bottom: 30px;
    }

    .search-input {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 50px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .files-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .file-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-top: 5px solid;
        display: flex;
        flex-direction: column;
    }

    .file-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .file-card.pdf {
        border-top-color: #f5576c;
    }

    .file-card.image {
        border-top-color: #4facfe;
    }

    .file-card.video {
        border-top-color: #43e97b;
    }

    .file-card.document {
        border-top-color: #fa709a;
    }

    .file-card.other {
        border-top-color: #667eea;
    }

    .file-card-header {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .file-icon {
        font-size: 40px;
        margin-bottom: 15px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .file-preview {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-preview:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .file-card.pdf .file-icon {
        color: #f5576c;
    }

    .file-card.image .file-icon {
        color: #4facfe;
    }

    .file-card.video .file-icon {
        color: #43e97b;
    }

    .file-card.document .file-icon {
        color: #fa709a;
    }

    .file-card.other .file-icon {
        color: #667eea;
    }

    .file-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        word-break: break-word;
        line-height: 1.4;
        flex-grow: 1;
    }

    .file-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        color: #999;
        margin-bottom: 0;
    }

    .file-size {
        background: #f5f5f5;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
        color: #666;
    }

    .file-card-footer {
        padding: 15px 20px;
        background: #f9f9f9;
        border-top: 1px solid #f0f0f0;
        display: flex;
        gap: 10px;
    }

    .file-card-footer button,
    .file-card-footer a {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-download {
        background: var(--gradient-3);
        color: white;
        border: none;
    }

    .btn-download:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
    }

    .btn-move {
        background: var(--gradient-4);
        color: white;
        border: none;
    }

    .btn-move:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(67, 233, 123, 0.3);
    }

    .btn-delete {
        background: var(--gradient-2);
        color: white;
        border: none;
    }

    .btn-delete:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(245, 87, 108, 0.3);
    }

    .empty-state {
        text-align: center;
        padding: 60px 30px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .empty-state i {
        font-size: 80px;
        background: var(--gradient-4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 20px;
        display: block;
    }

    .empty-state h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #999;
        margin-bottom: 30px;
        font-size: 1.05rem;
    }

    .btn-upload-primary {
        display: inline-block;
        background: var(--gradient-1);
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .btn-upload-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 20px;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .file-count {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-top: 10px;
    }

    @media (max-width: 768px) {
        .file-manager-header h2 {
            font-size: 1.8rem;
        }

        .file-stats {
            gap: 15px;
        }

        .files-container {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }

        .upload-section {
            padding: 30px 20px;
        }
    }
</style>

<div class="container-fluid">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
        <ol class="breadcrumb" style="background: white; padding: 15px 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
            @if($currentFolder)
                <li class="breadcrumb-item">
                    <a href="{{ route('files.index') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">
                        <i class='bx bx-folder' style="margin-left: 5px;"></i>
                        جميع الملفات
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #333; font-weight: 600;">
                    <i class='bx bx-folder-open' style="margin-left: 5px; color: #667eea;"></i>
                    {{ $currentFolder->name }}
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page" style="color: #333; font-weight: 600;">
                    <i class='bx bx-folder' style="margin-left: 5px; color: #667eea;"></i>
                    جميع الملفات
                </li>
            @endif
        </ol>
    </nav>

    <!-- Header Section -->
    <div class="file-manager-header">
        <h2>📁 {{ $currentFolder ? $currentFolder->name : 'إدارة الملفات' }}</h2>
        <div class="file-count">{{ $files->count() ?? 0 }} ملف{{ $currentFolder ? ' في هذا المجلد' : '' }}</div>
        <div class="file-stats">
            <div class="stat-item">
                <i class='bx bx-file'></i>
                <span>{{ $currentFolder ? 'ملفات المجلد' : 'جميع الملفات' }}</span>
            </div>
            @if(!$currentFolder)
            <div class="stat-item">
                <i class='bx bx-folder'></i>
                <span>{{ $folders->count() ?? 0 }} مجلد</span>
            </div>
            @endif
        </div>
    </div>

    <!-- Alerts -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class='bx bx-x-circle me-2'></i>خطأ!</strong> حدثت مشكلة في الرفع:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-2'></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Upload Section -->
    <div style="display: flex; gap: 15px; margin-bottom: 30px;">
        <div class="upload-section" data-toggle="modal" data-target="#uploadModal" style="flex: 1; margin-bottom: 0;">
            <i class='bx bx-cloud-upload'></i>
            <h3>رفع ملف جديد</h3>
            <p>اسحب الملف هنا أو انقر للاختيار</p>
        </div>
        @if(!$currentFolder)
        <div class="upload-section" data-toggle="modal" data-target="#createFolderModal"
             style="flex: 0.5; margin-bottom: 0; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); box-shadow: 0 10px 30px rgba(67, 233, 123, 0.3);">
            <i class='bx bx-folder-plus'></i>
            <h3>إنشاء مجلد جديد</h3>
            <p>تنظيم ملفاتك في مجلدات</p>
        </div>
        @endif
    </div>

    <!-- Search Bar -->
    <div class="search-wrapper">
        <input type="text" class="search-input" id="searchFiles" placeholder="🔍 ابحث عن الملفات...">
    </div>

    <!-- Folders Section (Only show in root view) -->
    @if(!$currentFolder && $folders && $folders->count() > 0)
        <div style="margin-bottom: 40px;">
            <h4 style="color: #333; font-weight: 700; margin-bottom: 20px; display: flex; align-items: center;">
                <i class='bx bx-folder' style="font-size: 24px; margin-left: 10px; color: #667eea;"></i>
                المجلدات
                <span style="background: #667eea; color: white; padding: 2px 12px; border-radius: 20px; font-size: 0.85rem; margin-right: 10px;">{{ $folders->count() }}</span>
            </h4>
            <div class="folders-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
                @foreach($folders as $folder)
                    <div class="folder-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px; padding: 25px; box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3); cursor: pointer; transition: all 0.3s ease; position: relative; color: white;"
                         onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 35px rgba(102, 126, 234, 0.4)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(102, 126, 234, 0.3)';"
                         onclick="window.location='{{ route('files.index', ['folder' => $folder->id]) }}'">

                        <div style="position: absolute; top: 15px; left: 15px; display: flex; gap: 5px;">
                            <button type="button" class="btn btn-sm"
                                    onclick="event.stopPropagation(); openRenameFolderModal({{ $folder->id }}, '{{ $folder->name }}')"
                                    style="background: rgba(255,255,255,0.2); border: none; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;"
                                    title="إعادة تسمية">
                                <i class='bx bx-edit' style="font-size: 16px;"></i>
                            </button>
                            <button type="button" class="btn btn-sm delete-folder-btn" data-folder-id="{{ $folder->id }}"
                                    onclick="event.stopPropagation();"
                                    style="background: rgba(255,255,255,0.2); border: none; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;"
                                    title="حذف">
                                <i class='bx bx-trash' style="font-size: 16px;"></i>
                            </button>
                        </div>

                        <div style="text-align: center; pointer-events: none;">
                            <i class='bx bx-folder' style="font-size: 64px; margin-bottom: 15px; display: block; opacity: 0.9;"></i>
                            <h5 style="font-weight: 700; margin-bottom: 10px; word-break: break-word;">{{ $folder->name }}</h5>
                            <div style="background: rgba(255,255,255,0.2); display: inline-block; padding: 5px 15px; border-radius: 20px; font-size: 0.9rem;">
                                <i class='bx bx-file' style="margin-left: 5px;"></i>
                                {{ $folder->files_count }} ملف
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Files Section Header -->
    @if(!$currentFolder || $files->count() > 0)
        <h4 style="color: #333; font-weight: 700; margin-bottom: 20px; display: flex; align-items: center;">
            <i class='bx bx-file' style="font-size: 24px; margin-left: 10px; color: #4facfe;"></i>
            الملفات
            <span style="background: #4facfe; color: white; padding: 2px 12px; border-radius: 20px; font-size: 0.85rem; margin-right: 10px;">{{ $files->count() }}</span>
        </h4>
    @endif

    <!-- Files Grid or Empty State -->
    @if($files && $files->count() > 0)
        <div class="files-container" id="filesGrid">
            @foreach ($files as $file)
                @php
                    $ext = strtolower(pathinfo($file->name, PATHINFO_EXTENSION));
                    if ($ext === 'pdf') {
                        $type = 'pdf';
                        $icon = 'bx-file-pdf';
                        $color = '#f5576c';
                    } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $type = 'image';
                        $icon = 'bx-image';
                        $color = '#4facfe';
                    } elseif (in_array($ext, ['mp4', 'avi', 'mov', 'mkv', 'webm'])) {
                        $type = 'video';
                        $icon = 'bx-video';
                        $color = '#43e97b';
                    } elseif (in_array($ext, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'])) {
                        $type = 'document';
                        $icon = 'bx-file';
                        $color = '#fa709a';
                    } else {
                        $type = 'other';
                        $icon = 'bx-file';
                        $color = '#667eea';
                    }
                @endphp

                <div class="file-card {{ $type }}" data-filename="{{ strtolower($file->name) }}">
                    <div class="file-card-header">
                        @if($type === 'image')
                            <img src="{{ asset('storage/' . $file->path) }}"
                                 alt="{{ $file->name }}"
                                 class="file-preview"
                                 data-toggle="modal"
                                 data-target="#imageModal-{{ $file->id }}"
                                 onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'file-icon\'><i class=\'bx bx-image text-muted\'></i></div>';">
                        @else
                            <div class="file-icon">
                                <i class='bx {{ $icon }}'></i>
                            </div>
                        @endif
                        <h5 class="file-name" title="{{ $file->name }}">{{ $file->name }}</h5>
                        <div class="file-meta">
                            <span>{{ $file->created_at->format('d/m/Y') }}</span>
                            <span class="file-size">{{ $file->size ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="file-card-footer">
                        <a href="{{ asset('storage/' . $file->path) }}" class="btn-download" download title="تحميل">
                            <i class='bx bx-download'></i>
                        </a>
                        <button type="button" class="btn-move" onclick="openMoveFileModal({{ $file->id }})" title="نقل">
                            <i class='bx bx-move'></i>
                        </button>
                        <button type="button" class="btn-delete delete-btn" data-file-id="{{ $file->id }}" title="حذف">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class='bx bx-folder-open'></i>
            <h3>لا توجد ملفات حالياً</h3>
            <p>ابدأ برفع ملفاتك الآن</p>
            <button type="button" class="btn-upload-primary" data-toggle="modal" data-target="#uploadModal">
                <i class='bx bx-cloud-upload me-2'></i>رفع ملف الآن
            </button>
        </div>
    @endif
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" style="font-weight: 700;">
                    <i class='bx bx-cloud-upload me-2'></i>رفع ملف
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="folder_id" value="{{ $currentFolder ? $currentFolder->id : '' }}">
                    @if($currentFolder)
                        <div class="alert alert-info" style="border-radius: 10px; background: #e3f2fd; border: none; color: #1976d2; margin-bottom: 20px;">
                            <i class='bx bx-info-circle' style="margin-left: 5px;"></i>
                            سيتم رفع الملف إلى مجلد: <strong>{{ $currentFolder->name }}</strong>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="file" class="form-label fw-600 mb-3">اختر الملف</label>
                        <div class="upload-drop-area" style="border: 2px dashed #667eea; border-radius: 12px; padding: 30px; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                            <i class='bx bx-cloud-upload' style="font-size: 48px; color: #667eea; display: block; margin-bottom: 10px;"></i>
                            <p class="mb-2" style="color: #667eea; font-weight: 600;">اسحب الملف هنا</p>
                            <p class="text-muted mb-3">أو انقر لاختيار ملف</p>
                            <input type="file" id="file" name="file" class="form-control d-none" required accept="*">
                        </div>
                        <small class="text-muted d-block mt-3">
                            <i class='bx bx-info-circle me-1'></i>الحد الأقصى: 100 MB
                        </small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn rounded-pill px-4" style="background: var(--gradient-1); color: white; border: none;">
                        <i class='bx bx-upload me-2'></i>رفع
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Image Preview Modals -->
@foreach ($files as $file)
    @php
        $ext = strtolower(pathinfo($file->name, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
    @endphp
        <div class="modal fade" id="imageModal-{{ $file->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content border-0" style="background: transparent;">
                    <div class="modal-header border-0" style="background: transparent;">
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 32px;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center p-0">
                        <img src="{{ asset('storage/' . $file->path) }}" alt="{{ $file->name }}" style="max-width: 100%; max-height: 85vh; border-radius: 12px;">
                    </div>
                    <div class="modal-footer border-0" style="background: transparent; justify-content: center;">
                        <a href="{{ asset('storage/' . $file->path) }}" download class="btn btn-light rounded-pill px-4">
                            <i class='bx bx-download me-2'></i>تحميل
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @php
        }
    @endphp
@endforeach

<!-- Delete File Form (Hidden) -->
<form id="deleteForm" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- Delete Folder Form (Hidden) -->
<form id="deleteFolderForm" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- Create Folder Modal -->
<div class="modal fade" id="createFolderModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" style="font-weight: 700;">
                    <i class='bx bx-folder-plus me-2'></i>إنشاء مجلد جديد
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('folders.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="folder_name" class="form-label fw-600 mb-2">اسم المجلد</label>
                        <input type="text" class="form-control" id="folder_name" name="name" required
                               placeholder="أدخل اسم المجلد" style="border-radius: 10px; padding: 12px;">
                        <small class="text-muted d-block mt-2">
                            <i class='bx bx-info-circle me-1'></i>اختر اسماً وصفياً للمجلد
                        </small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn rounded-pill px-4" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none;">
                        <i class='bx bx-plus me-2'></i>إنشاء المجلد
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Rename Folder Modal -->
<div class="modal fade" id="renameFolderModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" style="font-weight: 700;">
                    <i class='bx bx-edit me-2'></i>إعادة تسمية المجلد
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="renameFolderForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rename_folder_name" class="form-label fw-600 mb-2">اسم المجلد الجديد</label>
                        <input type="text" class="form-control" id="rename_folder_name" name="name" required
                               style="border-radius: 10px; padding: 12px;">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn rounded-pill px-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
                        <i class='bx bx-save me-2'></i>حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Move File Modal -->
<div class="modal fade" id="moveFileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" style="font-weight: 700;">
                    <i class='bx bx-move me-2'></i>نقل الملف
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="moveFileForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="move_folder_id" class="form-label fw-600 mb-2">اختر المجلد الوجهة</label>
                        <select class="form-control" id="move_folder_id" name="folder_id" style="border-radius: 10px; padding: 12px;">
                            <option value="">الجذر (بدون مجلد)</option>
                            @foreach($folders as $folder)
                                <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted d-block mt-2">
                            <i class='bx bx-info-circle me-1'></i>اختر "الجذر" لنقل الملف خارج جميع المجلدات
                        </small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn rounded-pill px-4" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none;">
                        <i class='bx bx-move me-2'></i>نقل الملف
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Drag and drop for upload modal
    const uploadDropArea = document.querySelector('.upload-drop-area');
    const fileInput = document.getElementById('file');

    if (uploadDropArea && fileInput) {
        uploadDropArea.addEventListener('click', () => fileInput.click());

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadDropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadDropArea.addEventListener(eventName, () => {
                uploadDropArea.style.backgroundColor = 'rgba(102, 126, 234, 0.1)';
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadDropArea.addEventListener(eventName, () => {
                uploadDropArea.style.backgroundColor = 'transparent';
            });
        });

        uploadDropArea.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
        });

        fileInput.addEventListener('change', (e) => {
            if (fileInput.files.length > 0) {
                document.getElementById('uploadForm').submit();
            }
        });
    }

    // Delete file functionality
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const fileId = this.dataset.fileId;
            if (confirm('هل أنت متأكد من حذف هذا الملف؟')) {
                document.getElementById('deleteForm').action = '{{ route("files.destroy", ":id") }}'.replace(':id', fileId);
                document.getElementById('deleteForm').submit();
            }
        });
    });

    // Delete folder functionality
    document.querySelectorAll('.delete-folder-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const folderId = this.dataset.folderId;
            if (confirm('هل أنت متأكد من حذف هذا المجلد؟ سيتم نقل جميع الملفات إلى الجذر.')) {
                document.getElementById('deleteFolderForm').action = '{{ route("folders.destroy", ":id") }}'.replace(':id', folderId);
                document.getElementById('deleteFolderForm').submit();
            }
        });
    });

    // Open rename folder modal
    function openRenameFolderModal(folderId, folderName) {
        document.getElementById('rename_folder_name').value = folderName;
        document.getElementById('renameFolderForm').action = '{{ route("folders.update", ":id") }}'.replace(':id', folderId);
        $('#renameFolderModal').modal('show');
    }

    // Open move file modal
    function openMoveFileModal(fileId) {
        document.getElementById('moveFileForm').action = '{{ route("files.move", ":id") }}'.replace(':id', fileId);
        $('#moveFileModal').modal('show');
    }

    // Search functionality with card filtering
    const searchInput = document.getElementById('searchFiles');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.file-card').forEach(card => {
                const fileName = card.dataset.filename || '';
                card.style.display = fileName.includes(searchTerm) ? '' : 'none';
            });
        });
    }

    // Main upload section
    const uploadSection = document.querySelector('.upload-section');
    if (uploadSection) {
        uploadSection.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadSection.style.transform = 'translateY(-8px)';
        });

        uploadSection.addEventListener('dragleave', () => {
            uploadSection.style.transform = 'translateY(0)';
        });
    }
</script>

@endsection
