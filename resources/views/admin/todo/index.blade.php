@extends('admin.index')
@section('admin')

<style>
.completed {
    text-decoration: line-through;
}
</style>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-0">To Do List</h4>
            <hr/>
            <form id="add-todo-form" action="{{ route('todo.store') }}" method="POST">
                @csrf
                <div class="row gy-3">
                    <div class="col-md-10">
                        <input id="todo-input" type="text" class="form-control" name="title" placeholder="Enter todo title">
                    </div>
                    <div class="col-md-2 text-end d-grid">
                        <button type="submit" class="btn btn-primary">Add todo</button>
                    </div>
                </div>
            </form>
            <div class="form-row mt-3">
                <div class="col-12" id="todo-container">
                    @foreach($todos as $todo)
                    <form action="{{ route('todos.update-status') }}" method="POST" class="d-flex align-items-center w-100">

                    <div class="input-group mb-2">
                            @csrf
                            <div class="input-group-text">
                                <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                <input type="checkbox" name="todos" value="1" {{ $todo->completed ? 'checked' : '' }} onchange="this.form.submit()">
                            </div>
                            <input type="text" class="form-control {{ $todo->completed ? 'completed' : '' }}" aria-label="Text input with checkbox" value="{{ $todo->title }}" readonly>
                        </form>
                        <form action="{{ route('todo.destroy', $todo) }}" method="POST" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-secondary bg-danger text-white">X</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
