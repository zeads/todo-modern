@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <div class="flex justify-between mb-5">
        <h1 class="text-2xl font-bold">
            Todo List
        </h1>

        <a href="{{ route('todos.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">
            Tambah Todo
        </a>
    </div>

    @foreach ($todos as $todo)

        <div class="border-b py-4">

            <h2 class="font-semibold text-lg">
                {{ $todo->title }}
            </h2>

            <p class="text-gray-600">
                {{ $todo->description }}
            </p>

        </div>

    @endforeach

</div>

@endsection
