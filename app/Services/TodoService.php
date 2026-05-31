<?php

namespace App\Services;

use App\Models\Todo;

class TodoService
{
    public function create(array $data): Todo
    {
        // return Todo::create($data);
        return auth()->user()->todos()->create($data);
    }

    public function update(Todo $todo, array $data): Todo
    {
        $todo->update($data);

        return $todo;
    }

    public function delete(Todo $todo): void
    {
        $todo->delete();
    }
}
