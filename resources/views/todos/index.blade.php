@extends('layouts.app')

@section('content')

<form method="GET"
      action="{{ route('todos.index') }}"
      class="mb-5">

    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Cari todo..."
           class="border rounded px-3 py-2">

    <select name="status"
            class="border rounded px-3 py-2">

        <option value="">
            Semua
        </option>

        <option value="completed"
            {{ request('status') == 'completed' ? 'selected' : '' }}>

            Selesai

        </option>

        <option value="pending"
            {{ request('status') == 'pending' ? 'selected' : '' }}>

            Belum Selesai

        </option>

    </select>

    <button class="bg-gray-800 text-white px-4 py-2 rounded">
        Search
    </button>

</form>

@if (session('success'))

    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>

@endif



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

            <div class="flex gap-2 mt-3">

                <a href="{{ route('todos.edit', $todo->id) }}"
                class="bg-yellow-500 text-white px-3 py-1 rounded">

                    Edit

                </a>

                <form action="{{ route('todos.destroy', $todo->id) }}"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                        Delete
                    </button>

                </form>

                <div class="mt-2">

                    @if ($todo->is_completed)

                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">
                            Selesai
                        </span>

                    @else

                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-sm">
                            Belum Selesai
                        </span>

                    @endif

                </div>
            </div>


        </div>



    @endforeach

    <div class="mt-5">
        {{ $todos->links() }}
    </div>

</div>

@endsection
