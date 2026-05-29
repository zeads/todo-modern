<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Services\TodoService;

class TodoController extends Controller
{
    protected TodoService $todoService;
    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }
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
    // public function store(Request $request)
    // {
        // $validated = $request->validate([
            //     'title' => 'required|max:255',
            //     'description' => 'nullable',
            // ]);

            // Todo::create($validated);

    public function store(StoreTodoRequest $request)
    {
        // Todo::create($request->validated());
        $this->todoService->create($request->validated());

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

    // public function update(Request $request, Todo $todo)
    // {
        //     $validated = $request->validate([
            //         'title' => 'required|max:255',
            //         'description' => 'nullable',
            //     ]);
            // $validated['is_completed'] = $request->has('is_completed');
            // $todo->update($validated);

    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $data = $request->validated();
        $data['is_completed'] = $request->has('is_completed');

        // $todo->update($data);
        $this->todoService->update($todo, $data);

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        // $todo->delete();
        $this->todoService->delete($todo);

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo berhasil dihapus');
    }
}
