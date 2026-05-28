<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // $todos = Todo::latest()->get();
    //     $todos = Todo::latest()->paginate(5);
    //     return view('todos.index', compact('todos'));
    // }

    public function index(Request $request)
    {
        $query = Todo::query();

        if ($request->search) {

            $query->where('title', 'like', '%' . $request->search . '%');

        }

        if ($request->status == 'completed') {

            $query->where('is_completed', true);

        }

        if ($request->status == 'pending') {

            $query->where('is_completed', false);

        }

        $todos = $query
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Todo::create($validated);

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $validated['is_completed'] =
            $request->has('is_completed');

        $todo->update($validated);

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo berhasil dihapus');
    }
}
