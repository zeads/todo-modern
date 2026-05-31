{{-- @extends('layouts.app')

@section('content') --}}

<x-app-layout>

@if ($errors->any())

    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">

        <ul>
            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach
        </ul>

    </div>

@endif

<div class="bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-5">
        Tambah Todo
    </h1>

    <form action="{{ route('todos.store') }}"
          method="POST">

        @csrf

        <div class="mb-4">
            <label class="block mb-1">
                Title
            </label>

            <input type="text"
                   name="title"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">
                Description
            </label>

            <textarea name="description"
                      class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Simpan
        </button>

    </form>

</div>

</x-app-layout>
{{-- @endsection --}}
