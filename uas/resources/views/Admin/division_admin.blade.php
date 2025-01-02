@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6 ">
        @foreach ($divisions as $division)
            <div class="bg-blue-600 text-white rounded-lg shadow-lg flex flex-col items-center p-6 transition transform hover:scale-105 hover:bg-blue-700">
                <p class="mt-2 text-lg font-semibold">{{ $division->divisi_name }}</p>
                <!-- Tombol See dengan division_id -->
                <a href="{{ route('admin.todo', ['division_id' => $division->id]) }}" 
                   class="mt-4 px-6 py-2 bg-white text-blue-600 rounded-lg font-bold hover:bg-blue-500 hover:text-white transition">
                    See
                </a>
            </div>
        @endforeach
    </div>
@endsection
