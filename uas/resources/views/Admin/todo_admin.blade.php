@extends('layouts.admin')

@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-11/12 mx-auto mt-10">
    <!-- Done Column -->
    <div class="bg-blue-500 rounded-lg shadow-lg p-6">
        <h2 class="text-white text-2xl font-semibold mb-6">✅ Done</h2>
        <div id="done-list" class="space-y-4">
            @foreach ($tasksGrouped['done'] ?? [] as $task)
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-bold text-lg text-gray-800">{{ $task->title }}</h3>
                    <p class="text-gray-600">{{ $task->description }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- In Progress Column -->
    <div class="bg-orange-500 rounded-lg shadow-lg p-6">
        <h2 class="text-white text-2xl font-semibold mb-6">⏳ In Progress</h2>
        <div id="inprogress-list" class="space-y-4">
            @foreach ($tasksGrouped['in_progress'] ?? [] as $task)
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-bold text-lg text-gray-800">{{ $task->title }}</h3>
                    <p class="text-gray-600">{{ $task->description }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Not Yet Column -->
    <div class="bg-red-500 rounded-lg shadow-lg p-6">
        <h2 class="text-white text-2xl font-semibold mb-6">🛑 Not Yet</h2>
        <div id="notyet-list" class="space-y-4">
            @foreach ($tasksGrouped['not_yet'] ?? [] as $task)
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-bold text-lg text-gray-800">{{ $task->title }}</h3>
                    <p class="text-gray-600">{{ $task->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Button to open the modal -->
<button id="show-modal"
    class="fixed bottom-10 right-10 bg-blue-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-blue-700 transition">
    + Add Task
</button>

<!-- Modal for adding a new task -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-all">
    <div class="bg-white rounded-lg shadow-xl p-8 w-11/12 md:w-1/2">
        <h2 class="text-gray-800 text-2xl font-bold mb-6">Add New Task</h2>
        <form id="add-task-form" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" name="title" id="title"
                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description" id="description"
                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500"
                    required></textarea>
            </div>

            <div class="mb-6">
                <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                <select name="status" id="status"
                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500">
                    <option value="done">Done</option>
                    <option value="in_progress">In Progress</option>
                    <option value="not_yet">Not Yet</option>
                </select>
            </div>

            <button type="button" id="close-modal"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancel</button>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition submit">Submit</button>
    </div>
</div>
</div>

<script>
    const modal = document.getElementById('modal');
    const showModalBtn = document.getElementById('show-modal');
    const closeModalBtn = document.getElementById('close-modal');
    const form = document.getElementById('add-task-form');

    showModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        console.log("Sending fetch request to /tasks with formData:", Object.fromEntries(formData));

        try {
            const response = await fetch('/tasks', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: formData,
            });

            console.log("Response status:", response.status);

            if (!response.ok) {
                const errorResponse = await response.json();
                console.error('Server response error:', errorResponse);
                throw new Error(errorResponse.error || 'Failed to submit form');
            }

            const task = await response.json();
            console.log('Task added successfully:', task);

            const listId = task.status === 'done' ? 'done-list'
                            : task.status === 'in_progress' ? 'inprogress-list'
                            : 'notyet-list';

            const container = document.getElementById(listId);

            const newTask = document.createElement('div');
            newTask.className = 'bg-white p-4 rounded-lg shadow hover:shadow-lg transition';
            newTask.innerHTML = `
                <h3 class="font-bold text-lg text-gray-800">${task.title}</h3>
                <p class="text-gray-600">${task.description}</p>
            `;
            container.appendChild(newTask);

            form.reset();
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        } catch (error) {
            console.error('Error:', error);
            alert('Failed to add task');
        }
    });
</script>

@endsection