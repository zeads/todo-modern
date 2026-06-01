<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(
            auth()
                ->user()
                ->todos()
                ->latest()
                ->paginate(10)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
           'title' => 'required|max:255',
           'description' => 'nullable',
        ]);

        $todo = auth()
            ->user()
            ->todos()
            ->create($data);

        // return new TodoResource($todo);
        // return (new TodoResource($todo))
        //     ->response()
        //     ->setStatusCode(201);

        return ApiResponse::success(
            new TodoResource($todo),
            'Todo created successfully.',
            201
        );
    }
}
