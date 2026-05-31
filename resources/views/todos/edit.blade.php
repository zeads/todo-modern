{{-- @extends('layouts.app')

@section('content') --}}

<x-app-layout>

<div class="bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-5">
        Edit Todo
    </h1>

    @if ($errors->any())

        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">

            <ul>
                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach
            </ul>

        </div>

    @endif

    <form action="{{ route('todos.update', $todo->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block mb-1">
                Title
            </label>

            <input type="text"
                   name="title"
                   value="{{ old('title', $todo->title) }}"
                   class="w-full border rounded px-3 py-2">

        </div>

        <div class="mb-4">

            <label class="block mb-1">
                Description
            </label>

            <textarea name="description"
                      class="w-full border rounded px-3 py-2">{{ old('description', $todo->description) }}</textarea>

        </div>

        <div class="mb-4">

            <label class="flex items-center gap-2">

                <input type="checkbox"
                       name="is_completed"
                       value="1"
                       {{ $todo->is_completed ? 'checked' : '' }}>

                Selesai

            </label>

        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>

</div>

</x-app-layout>
{{-- @endsection --}}
