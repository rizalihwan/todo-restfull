<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todo = Todo::latest()->get();
        return TodoResource::collection($todo);
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required'
        ]);
        $todo = auth()->user()->todos()->create([
            'title' => request('title'),
            'slug' => \Str::slug(request('title').\Str::random(10)),
            'description' => request('description')
        ]);
        return new TodoResource($todo);
    }

    public function destroy(Todo $todo)
    {
        try {
            $todo->delete();
        } catch (\Exception $e) {
            return response()->json(['error' => "Something went wront".$e]);
        }
        return response()->json(['success' => "Todo deleted successfully!"]);
    }

    public function update(Todo $todo)
    {
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required'
        ]);
        $todo = $todo->update([
            'title' => request('title'),
            'description' => request('description')
        ]);
        return response()->json(['success' => "Todo updated successfully!"]);
    }
}
