<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDo;


    
 class TodoController extends Controller
    {
        // Display a listing of the resource.
        public function index()
        {
            $todos = ToDo::all();
            return view('admin.todo.index', compact('todos'));
        }
    
 
    
        // Store a newly created resource in storage.
        public function store(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:255',
            ]);
    
            ToDo::create($request->all());
    
            return redirect()->route('todo.index');
        }
    
  
    
        // Update the specified resource in storage.
        public function update(Request $request, ToDo $todo)
        {
            $request->validate([
                'title' => 'required|string|max:255',
            ]);
    
            $todo->update($request->all());
    
            return redirect()->route('todo.index')->with('success', 'Todo updated successfully!');
        }
    
        // Remove the specified resource from storage.
        public function destroy(ToDo $todo)
        {
            $todo->delete();
    
            return redirect()->route('todo.index')->with('success', 'Todo deleted successfully!');
        }

        public function updateStatus(Request $request)
        {
            // Get the todo ID from the form
            $todoId = $request->input('todos');
            
            // If no todo is checked (unchecked checkbox), $todoId will be 0
            if ($todoId !== null && $todoId !== 0) {
                // Find the todo
                $todo = Todo::findOrFail($todoId);
            
                // Toggle the completion status
                $todo->completed = !$todo->completed;
            
                // Save the changes
                $todo->save();
            } else {
                // If the checkbox is unchecked, set completed to false
                $todo->completed = false;
                $todo->save();
            }
        
            // Redirect back or return a response as needed
            return redirect()->back();
        }
        
        
    }
    

