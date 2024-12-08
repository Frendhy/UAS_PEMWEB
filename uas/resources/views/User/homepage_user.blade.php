@extends('layouts.user')

@section('content')
<div class="grid grid-cols-2 gap-6 p-6">
        <!-- Card 1 -->
        <div class="bg-blue-600 p-6 rounded-lg shadow-lg flex flex-col items-center">
            <h3 class="text-2xl mb-4">Divisi 1</h3>
            <a href="{{ route('user.components.show', ['id' => 1]) }}"
                class="bg-white text-blue-600 px-4 py-2 rounded-full hover:bg-yellow-500">See</a>
        </div>
        <!-- Card 2 -->
        <div class="bg-blue-600 p-6 rounded-lg shadow-lg flex flex-col items-center">
            <h3 class="text-2xl mb-4">Divisi 2</h3>
            <a href="{{ route('user.components.show', ['id' => 2]) }}"
                class="bg-white text-blue-600 px-4 py-2 rounded-full hover:bg-yellow-500">See</a>
        </div>
        <!-- Card 3 -->
        <div class="bg-blue-600 p-6 rounded-lg shadow-lg flex flex-col items-center">
            <h3 class="text-2xl mb-4">Divisi 3</h3>
            <a href="{{ route('user.components.show', ['id' => 3]) }}"
                class="bg-white text-blue-600 px-4 py-2 rounded-full hover:bg-yellow-500">See</a>
        </div>
        <!-- Card 4 -->
        <div class="bg-blue-600 p-6 rounded-lg shadow-lg flex flex-col items-center">
            <h3 class="text-2xl mb-4">Divisi 4</h3>
            <a href="{{ route('user.components.show', ['id' => 4]) }}"
                class="bg-white text-blue-600 px-4 py-2 rounded-full hover:bg-yellow-500">See</a>
        </div>
    </div>
@endsection
