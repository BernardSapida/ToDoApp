<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDoModel;
use Illuminate\Support\Facades\Log;

class ToDoController extends Controller
{
    public function index() {
        return view('index')->with('list', ToDoModel::all()); 
    }

    public function store(Request $request, ToDoModel $todo) {
        $todo -> create($request->all());
        return redirect()->route('todo.index')->with('success', "Todo created successfully");
    }

    public function update(Request $request, ToDoModel $todo) {
        $todo -> update($request->all());
        return redirect()->route('todo.index')->with('success', "Todo updated successfully");
    }

    public function status(ToDoModel $todo) {
        $todo->status = ($todo->status == "Not Started") ? "Completed" : "Not Started";
        $todo->save();
        return redirect()->route('todo.index')->with('success', "Todo status updated successfully");
    }

    public function destroy(ToDoModel $todo) {
        $todo->delete();
        return redirect()->route('todo.index')->with('success', "Todo deleted successfully!");
    }
}
