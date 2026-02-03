@extends('admin.index')
@section('admin')

<div class="col-12">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">📋 قائمة المهام</h4>
            <p class="text-muted mb-0">نظم مهامك وتابع إنجازاتك</p>
        </div>
        @if($todos->count() > 0)
        <div class="progress-circle">
            @php
                $completedCount = $todos->where('completed', true)->count();
                $totalCount = $todos->count();
                $percentage = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0;
            @endphp
            <div class="circle-progress" data-percent="{{ $percentage }}">
                <svg width="80" height="80">
                    <circle cx="40" cy="40" r="35" fill="none" stroke="#e9ecef" stroke-width="6"></circle>
                    <circle cx="40" cy="40" r="35" fill="none" stroke="#28a745" stroke-width="6"
                            stroke-dasharray="{{ 2 * 3.14159 * 35 }}"
                            stroke-dashoffset="{{ 2 * 3.14159 * 35 * (1 - $percentage / 100) }}"
                            transform="rotate(-90 40 40)"></circle>
                    <text x="40" y="45" text-anchor="middle" font-size="16" font-weight="bold" fill="#28a745">
                        {{ $percentage }}%
                    </text>
                </svg>
            </div>
        </div>
        @endif
    </div>

    <div class="row">
        <!-- Add Todo Card -->
        <div class="col-lg-4">
            <div class="card add-todo-card">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-plus-circle text-primary ml-2"></i>
                        مهمة جديدة
                    </h5>
                    <form id="add-todo-form" action="{{ route('todo.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea id="todo-input"
                                   class="form-control"
                                   name="title"
                                   rows="3"
                                   placeholder="اكتب مهمتك الجديدة..."
                                   required></textarea>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-paper-plane ml-2"></i> إضافة المهمة
                        </button>
                    </form>
                </div>
            </div>

            <!-- Stats Cards -->
            @if($todos->count() > 0)
            <div class="stats-cards">
                <div class="stat-card stat-completed">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $todos->where('completed', true)->count() }}</h3>
                        <p>منجزة</p>
                    </div>
                </div>
                <div class="stat-card stat-pending">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $todos->where('completed', false)->count() }}</h3>
                        <p>قيد التنفيذ</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Todo List -->
        <div class="col-lg-8">
            <div class="todo-tabs">
                <button class="tab-btn active" onclick="filterTodos('all')">
                    <i class="fas fa-list ml-2"></i> الكل ({{ $todos->count() }})
                </button>
                <button class="tab-btn" onclick="filterTodos('pending')">
                    <i class="fas fa-hourglass-half ml-2"></i> قيد التنفيذ ({{ $todos->where('completed', false)->count() }})
                </button>
                <button class="tab-btn" onclick="filterTodos('completed')">
                    <i class="fas fa-check-double ml-2"></i> منجزة ({{ $todos->where('completed', true)->count() }})
                </button>
            </div>

            <div id="todo-container" class="todos-list">
                @forelse($todos as $todo)
                    <div class="todo-card {{ $todo->completed ? 'completed' : 'pending' }}" data-status="{{ $todo->completed ? 'completed' : 'pending' }}">
                        <div class="todo-checkbox">
                            <form action="{{ route('todos.update-status') }}" method="POST" class="mb-0">
                                @csrf
                                <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                <label class="custom-checkbox">
                                    <input type="checkbox"
                                           name="todos"
                                           {{ $todo->completed ? 'checked' : '' }}
                                           onchange="this.form.submit()">
                                    <span class="checkmark"></span>
                                </label>
                            </form>
                        </div>

                        <div class="todo-content">
                            <h6 class="todo-title {{ $todo->completed ? 'completed-text' : '' }}">
                                {{ $todo->title }}
                            </h6>
                            <div class="todo-meta">
                                <span class="todo-date">
                                    <i class="fas fa-calendar-alt ml-1"></i>
                                    {{ $todo->created_at->locale('ar')->diffForHumans() }}
                                </span>
                                @if($todo->completed)
                                <span class="todo-badge badge-success">
                                    <i class="fas fa-check ml-1"></i> منجزة
                                </span>
                                @else
                                <span class="todo-badge badge-warning">
                                    <i class="fas fa-spinner ml-1"></i> جارية
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="todo-actions">
                            <form action="{{ route('todo.destroy', $todo) }}" method="POST" class="mb-0" onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-delete" title="حذف">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-clipboard-list"></i>
                        <h5>لا توجد مهام بعد</h5>
                        <p>ابدأ بإضافة مهمتك الأولى</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Modern Todo List Styles */
    :root {
        --primary-color: #0F302E;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
    }

    .add-todo-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.07);
        margin-bottom: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .add-todo-card .card-title {
        color: white;
    }

    .add-todo-card .form-control {
        border-radius: 10px;
        border: 2px solid rgba(255,255,255,0.2);
        background: rgba(255,255,255,0.9);
        resize: none;
    }

    .add-todo-card .form-control:focus {
        border-color: white;
        box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
    }

    .add-todo-card .btn-primary {
        background: white;
        color: #667eea;
        border: none;
        font-weight: 600;
        border-radius: 10px;
        padding: 12px;
    }

    .add-todo-card .btn-primary:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .stats-cards {
        display: grid;
        gap: 15px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.07);
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }

    .stat-completed {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .stat-pending {
        background: linear-gradient(135deg, #F2994A 0%, #F2C94C 100%);
        color: white;
    }

    .stat-icon {
        font-size: 40px;
        margin-left: 20px;
        opacity: 0.8;
    }

    .stat-content h3 {
        margin: 0;
        font-size: 32px;
        font-weight: 700;
    }

    .stat-content p {
        margin: 0;
        font-size: 14px;
        opacity: 0.9;
    }

    .todo-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        background: white;
        padding: 15px;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .tab-btn {
        flex: 1;
        padding: 12px 20px;
        border: 2px solid #e9ecef;
        background: white;
        color: #6c757d;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .tab-btn:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .tab-btn.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .todos-list {
        display: grid;
        gap: 15px;
    }

    .todo-card {
        display: flex;
        align-items: center;
        padding: 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        transition: all 0.3s;
        border-right: 4px solid #28a745;
    }

    .todo-card.completed {
        border-right-color: #28a745;
        opacity: 0.7;
    }

    .todo-card.pending {
        border-right-color: #ffc107;
    }

    .todo-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        transform: translateX(-5px);
    }

    .todo-checkbox {
        margin-left: 15px;
    }

    .custom-checkbox {
        position: relative;
        cursor: pointer;
        user-select: none;
    }

    .custom-checkbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .checkmark {
        display: block;
        height: 30px;
        width: 30px;
        background-color: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .custom-checkbox:hover .checkmark {
        background-color: #e9ecef;
    }

    .custom-checkbox input:checked ~ .checkmark {
        background-color: var(--success-color);
        border-color: var(--success-color);
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .custom-checkbox input:checked ~ .checkmark:after {
        display: block;
    }

    .custom-checkbox .checkmark:after {
        right: 9px;
        top: 5px;
        width: 7px;
        height: 12px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .todo-content {
        flex: 1;
    }

    .todo-title {
        margin: 0 0 8px 0;
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
    }

    .completed-text {
        text-decoration: line-through;
        color: #999;
    }

    .todo-meta {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .todo-date {
        font-size: 13px;
        color: #6c757d;
    }

    .todo-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-success {
        background: #d4edda;
        color: #155724;
    }

    .badge-warning {
        background: #fff3cd;
        color: #856404;
    }

    .todo-actions {
        margin-right: 15px;
    }

    .btn-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        border: none;
        background: #f8f9fa;
        color: #6c757d;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
        transform: scale(1.1);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
    }

    .empty-state i {
        font-size: 80px;
        color: #dee2e6;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        color: #6c757d;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #adb5bd;
    }

    .progress-circle {
        background: white;
        border-radius: 50%;
        padding: 5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    @media (max-width: 768px) {
        .todo-tabs {
            flex-direction: column;
        }

        .tab-btn {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function filterTodos(status) {
        const tabs = document.querySelectorAll('.tab-btn');
        const todos = document.querySelectorAll('.todo-card');

        tabs.forEach(tab => tab.classList.remove('active'));
        event.target.closest('.tab-btn').classList.add('active');

        todos.forEach(todo => {
            if (status === 'all') {
                todo.style.display = 'flex';
            } else {
                if (todo.dataset.status === status) {
                    todo.style.display = 'flex';
                } else {
                    todo.style.display = 'none';
                }
            }
        });
    }

    // Auto-focus on input after page load
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('todo-input').focus();
    });
</script>
@endpush
