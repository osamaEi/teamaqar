@extends('admin.index')
@section('admin')

<style>
    .completed {
        text-decoration: line-through;
        color: #999;
    }

    .todo-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .todo-item:hover {
        background: #e9ecef;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .todo-text {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-delete {
        padding: 6px 12px;
        font-size: 13px;
    }
</style>

<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list-check text-primary ml-2"></i>
                قائمة المهام
            </h3>
        </div>

        <div class="card-body">
            <!-- Add Todo Form -->
            <form id="add-todo-form" action="{{ route('todo.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="row gy-2">
                    <div class="col-md-10">
                        <input id="todo-input"
                               type="text"
                               class="form-control form-control-lg"
                               name="title"
                               placeholder="أدخل عنوان المهمة الجديدة..."
                               required>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-plus ml-2"></i> إضافة
                        </button>
                    </div>
                </div>
            </form>

            <hr class="my-3">

            <!-- Todo List -->
            <div id="todo-container">
                @forelse($todos as $todo)
                    <div class="todo-item">
                        <!-- Checkbox Form -->
                        <form action="{{ route('todos.update-status') }}" method="POST" class="d-inline mb-0">
                            @csrf
                            <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                            <input type="checkbox"
                                   class="form-check-input"
                                   {{ $todo->completed ? 'checked' : '' }}
                                   onchange="this.form.submit()"
                                   style="cursor: pointer; width: 20px; height: 20px;">
                        </form>

                        <!-- Todo Title -->
                        <div class="todo-text">
                            <i class="fas fa-tasks text-info"></i>
                            <span class="{{ $todo->completed ? 'completed' : '' }}">{{ $todo->title }}</span>
                        </div>

                        <!-- Delete Form -->
                        <form action="{{ route('todo.destroy', $todo) }}" method="POST" class="d-inline mb-0" onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-delete" title="حذف المهمة">
                                <i class="fas fa-trash ml-1"></i> حذف
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="alert alert-info text-center" role="alert">
                        <i class="fas fa-inbox fa-2x mb-2"></i>
                        <p class="mb-0">لا توجد مهام حالياً. أضف مهمتك الأولى!</p>
                    </div>
                @endforelse
            </div>

            <!-- Stats -->
            @if($todos->count() > 0)
                <hr class="my-3">
                <div class="row text-center">
                    <div class="col-md-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $todos->where('completed', true)->count() }}</h3>
                                <p>المهام المنجزة</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $todos->where('completed', false)->count() }}</h3>
                                <p>المهام المتبقية</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
