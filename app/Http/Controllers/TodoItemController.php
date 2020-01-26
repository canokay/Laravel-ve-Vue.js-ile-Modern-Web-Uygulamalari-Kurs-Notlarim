<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TodoItem;
use Carbon\Carbon;

class TodoItemController extends Controller
{
    public function index()
    {
        $todos = TodoItem::all();
        return view('todos', ['todos' => $todos]);
    }

    public function toggle(TodoItem $todo)
    {
        $todo->toggle();
        $todo->save();
        return redirect()->route('todos.all');
    }
    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required|string|min:3|max:250'
        ]);


        $todo = new TodoItem;
        $todo->text = $request->todo;
        $todo->save();
        return redirect()->route('todos.all');
    }
}