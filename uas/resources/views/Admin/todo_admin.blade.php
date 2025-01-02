@extends('layouts.admin')

@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<h1 class="text-2xl font-bold text-blue-600 mb-6">
    {{ $currentDivision->divisi_name ?? 'All Divisions' }}
</h1>


<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <?php
$statuses = [
    'done' => ['title' => '✅ Done', 'color' => 'bg-blue-500'],
    'in_progress' => ['title' => '⏳ In Progress', 'color' => 'bg-orange-500'],
    'not_yet' => ['title' => '🛑 Not Yet', 'color' => 'bg-red-500'],
];
    ?>

    @foreach ($statuses as $status => $config)
        <div id="{{ $status }}-list" class="{{ $config['color'] }} rounded-lg shadow-lg p-6 task-category"
            data-status="{{ $status }}">
            <h2 class="text-white text-2xl font-semibold mb-6">{{ $config['title'] }}</h2>
            <div class="space-y-4">
                @forelse ($tasksGrouped[$status] as $task)
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition task-item" draggable="true"
                        data-id="{{ $task->id }}" data-title="{{ $task->title }}" data-deadline="{{ $task->deadline }}">
                        <h3 class="font-bold text-lg text-gray-800">{{ $task->title }}</h3>
                        <p class="text-gray-600">{{ $task->description }}</p>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    @endforeach
    <div id="notification"
        class="top-4 left-4 bg-yellow text-gray-900 px-6 py-4 rounded-lg shadow-lg hidden flex items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <span>Task submitted successfully!</span>
    </div>
</div>

<!-- Comment and Upload Modal -->
@foreach ($tasks as $task)
    <div id="comment-upload-modal-{{ $task->id }}"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden comment-upload-modal">
        <div class="bg-white mx-6 lg:mx-20 p-6 rounded-lg shadow-xl flex relative">
            <!-- Left Side: Task Details -->
            <div class="w-1/2 pr-4 border-r">
                <h2 class="text-2xl font-semibold mb-4">Task Details</h2>
                <p id="modal-status-{{ $task->id }}" class="text-gray-600 mb-2">Status: {{ $task->status }}</p>
                <p id="modal-title-{{ $task->id }}" class="text-gray-800 font-semibold mb-2">Title: {{ $task->title }}</p>
                <p id="modal-deadline-{{ $task->id }}" class="text-gray-600 mb-4">Deadline: {{ $task->deadline }}</p>
                <div class="flex space-x-4">
                    <button data-id="{{ $task->id }}"
                        class="edit-task-btn px-4 py-2 bg-blue-500 text-white rounded">Edit</button>
                    <button data-id="{{ $task->id }}"
                        class="delete-task-btn px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                </div>
            </div>
            <!-- Right Side: Comment and Upload -->
            <div class="w-1/2 pl-4">
                <!-- Form Section -->
                <form id="comment-upload-form-{{ $task->id }}" method="POST" enctype="multipart/form-data"
                    class="flex flex-col h-full">
                    @csrf
                    <!-- Chatbox Input -->
                    <div class="flex items-center bg-gray-100 border border-gray-300 rounded-lg p-4 space-x-4">
                        <!-- File Input -->
                        <label
                            class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full cursor-pointer hover:bg-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-paperclip" viewBox="0 0 16 16">
                                <path
                                    d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z" />
                            </svg>
                            <input type="file" name="file" class="hidden" id="task-file-{{ $task->id }}">
                        </label>
                        <!-- Textarea -->
                        <textarea name="comment" class="flex-grow p-2 bg-transparent focus:outline-none resize-none"
                            placeholder="Add a comment" rows="1"></textarea>
                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                    <!-- Comments Section -->
                    <div id="task-comments-{{ $task->id }}" class="mt-6 flex-grow h-64 overflow-y-auto">
                        <h3 class="text-sm font-bold text-blue-600">Comments</h3>
                        @forelse ($task->comments as $comment)
                            <div class="p-4 bg-gray-100 rounded-lg shadow mb-4">
                                <div class="flex items-center justify-between mb-2">
                                    <p class="font-bold text-gray-800">{{ $comment->user->name }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($comment->created_at)->timezone('Asia/Bangkok')->format('d M Y, H:i') }}
                                    </p>
                                </div>
                                <p class="text-gray-700 mb-2">{{ $comment->comment }}</p>
                                @if ($comment->file_path)
                                    <a href="{{ asset('storage/' . $comment->file_path) }}" target="_blank"
                                        class="text-blue-500 hover:underline">📎 View Attachment</a>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-500">No comments yet.</p>
                        @endforelse
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<!-- Edit Task Modal -->
<div id="edit-task-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-xl p-8 w-11/12 md:w-1/2">
        <h2 class="text-gray-800 text-2xl font-bold mb-6">Edit Task</h2>
        <form id="edit-task-form" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit-task-id">

            <div class="mb-4">
                <label for="edit-division_id" class="block text-gray-700 font-bold mb-2">Division</label>
                <select name="division_id" id="edit-division_id"
                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500"
                    required>
                    @if ($currentDivision)
                        <option value="{{ $currentDivision->id }}" selected>{{ $currentDivision->divisi_name }}</option>
                    @else
                        <option value="" disabled selected>Select a division</option>
                    @endif
                </select>
            </div>

            <div class="mb-4">
                <label for="edit-title" class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" name="title" id="edit-title"
                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="edit-description" class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description" id="edit-description"
                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500"
                    required></textarea>
            </div>

            <div class="mb-6">
                <label for="edit-status" class="block text-gray-700 font-bold mb-2">Status</label>
                <select name="status" id="edit-status"
                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500">
                    <option value="done">Done</option>
                    <option value="in_progress">In Progress</option>
                    <option value="not_yet">Not Yet</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="edit-deadline" class="block text-gray-700 font-bold mb-2">Deadline</label>
                <input type="datetime-local" id="edit-deadline" name="deadline"
                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex justify-end gap-4">
                <button type="button" id="close-edit-modal"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancel</button>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Update</button>
            </div>
        </form>
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
                <label for="division_id" class="block text-gray-700 font-bold mb-2">Division</label>
                <select name="division_id" id="division_id"
                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500"
                    required>
                    @if ($currentDivision)
                        <option value="{{ $currentDivision->id }}" selected>{{ $currentDivision->divisi_name }}</option>
                    @else
                        <option value="" disabled selected>Select a division</option>
                    @endif
                </select>
            </div>

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

            <div class="mb-6">
                <label for="deadline" class="block text-gray-700 font-bold mb-2">Deadline</label>
                <input type="datetime-local" id="deadline" name="deadline"
                    class="w-full border-gray-300 border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <button type="button" id="close-modal"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancel</button>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition submit">Submit</button>
        </form>

        <div id="create"
            class="hidden fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded shadow-lg">
            Task added successfully!
        </div>
    </div>
</div>


<script>
    const modal = document.getElementById('modal');
    const showModalBtn = document.getElementById('show-modal');
    const closeModalBtn = document.getElementById('close-modal');
    const form = document.getElementById('add-task-form');
    document.addEventListener('DOMContentLoaded', () => {
        initDragAndDrop();

        document.querySelectorAll('.task-item').forEach(item => {
            item.addEventListener('click', function () {
                const taskId = this.dataset.id;
                const title = this.dataset.title;
                const status = this.closest('.task-category').dataset.status;
                const deadline = this.dataset.deadline;

                document.getElementById('modal-title').innerText = `Title: ${title}`;
                document.getElementById('modal-status').innerText = `Status: ${status}`;
                document.getElementById('modal-deadline').innerText = `Deadline: ${deadline}`;

                document.getElementById('comment-upload-form').action = `/tasks/${taskId}/comments`;

                document.getElementById('comment-upload-modal').classList.remove('hidden');
            });
        });

        document.getElementById('comment-upload-modal').addEventListener('click', function (e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    });

    function showAlertCreate() {
        const alert = document.getElementById('create');
        alert.classList.remove('hidden');
        alert.classList.add('block');

        setTimeout(() => {
            alert.classList.add('hidden');
            alert.classList.remove('block');
        }, 3000);
    }

    showModalBtn.addEventListener('click', () => {
        const modal = document.getElementById('modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });


    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        try {
            const response = await fetch('/tasks', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: formData,
            });

            if (!response.ok) {
                throw new Error('Failed to submit form');
            }

            const task = await response.json();

            const listId = task.status === 'done' ? 'done-list' :
                task.status === 'in_progress' ? 'inprogress-list' :
                    'notyet-list';

            const container = document.getElementById(listId);

            const newTask = document.createElement('div');
            newTask.className = 'bg-white mt-4 p-4 rounded-lg shadow hover:shadow-lg transition';
            newTask.innerHTML = `
            <h3 class="font-bold text-lg text-gray-800">${task.title}</h3>
            <p class="text-gray-600">${task.description}</p>
        `;
            container.appendChild(newTask);

            form.reset();
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            showAlertCreate();
        } catch (error) {
            console.error('Error:', error);
        }finally {
        location.reload(); 
    }
    });

    document.getElementById('add-task-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const notification = document.getElementById('notification');
        notification.classList.remove('hidden');
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 5000);

    });

    document.getElementById('close-modal').addEventListener('click', function () {
        document.getElementById('modal').classList.add('hidden');
    });

    //edit task
    document.addEventListener('DOMContentLoaded', () => {
        const editModal = document.getElementById('edit-task-modal');
        const closeEditModalBtn = document.getElementById('close-edit-modal');
        const editForm = document.getElementById('edit-task-form');

        document.querySelectorAll('.edit-task-btn').forEach(button => {
            button.addEventListener('click', async function () {
                const taskId = this.dataset.id;

                try {
                    const response = await fetch(`/tasks/${taskId}`);
                    const task = await response.json();

                    if (response.ok) {
                        document.getElementById('edit-task-id').value = task.id;
                        document.getElementById('edit-division_id').value = task.division_id;
                        document.getElementById('edit-title').value = task.title;
                        document.getElementById('edit-description').value = task.description;
                        document.getElementById('edit-status').value = task.status;
                        document.getElementById('edit-deadline').value = task.deadline;

                        editModal.classList.remove('hidden');
                    } else {
                        alert('Failed to fetch task data');
                    }
                } catch (error) {
                    console.error(error);
                    alert('An error occurred while fetching the task data');
                }
            });
        });
        closeEditModalBtn.addEventListener('click', () => {
            editModal.classList.add('hidden');
        });
        editForm.addEventListener('submit', async (e) => {

            e.preventDefault();

            const taskId = document.getElementById('edit-task-id').value;
            const formData = new FormData(editForm);

            const updatedTask = {
                title: formData.get('title'),
                description: formData.get('description'),
                status: formData.get('status'),
                deadline: formData.get('deadline'),
            };

            try {
                const response = await fetch(`/tasks/${taskId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify(updatedTask),
                });

                if (response.ok) {
                    location.reload();
                    editModal.classList.add('hidden');
                } else {
                    alert('Failed to update task');
                }
            } catch (error) {
                console.error(error);
                alert('An error occurred while updating the task');
            }
        });
    });
    document.getElementById('edit-task-modal').addEventListener('click', function (e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
    //delete task
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.delete-task-btn').forEach(button => {
            button.addEventListener('click', async function () {
                const taskId = this.dataset.id;

                if (confirm('Are you sure you want to delete this task?')) {
                    try {
                        const response = await fetch(`/tasks/${taskId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                        });

                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Failed to delete task');
                        }
                    } catch (error) {
                        console.error(error);
                    }
                }
            });
        });
    });

    //comment task
    document.addEventListener('DOMContentLoaded', () => {
        initDragAndDrop();
        document.querySelectorAll('.task-item').forEach(item => {
            item.addEventListener('click', function () {
                const taskId = this.dataset.id;
                const title = this.dataset.title;
                const status = this.closest('.task-category').dataset.status;
                const deadline = this.dataset.deadline;

                const modal = document.getElementById(`comment-upload-modal-${taskId}`);
                if (!modal) {
                    console.error(`Modal for task ID ${taskId} not found.`);
                    return;
                }

                modal.querySelector(`#modal-title-${taskId}`).innerText = `Title: ${title}`;
                modal.querySelector(`#modal-status-${taskId}`).innerText = `Status: ${status}`;
                modal.querySelector(`#modal-deadline-${taskId}`).innerText = `Deadline: ${deadline}`;

                modal.querySelector(`#comment-upload-form-${taskId}`).action = `/tasks/${taskId}/comments`;

                modal.classList.remove('hidden');
            });
        });
    });
    document.querySelectorAll('.comment-upload-modal').forEach(modal => {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });

    //drag and drop task
    function initDragAndDrop() {
        document.querySelectorAll('.task-item').forEach(task => {
            task.addEventListener('dragstart', function (e) {
                e.dataTransfer.setData('task-id', this.dataset.id);
            });
        });

        document.querySelectorAll('.task-category').forEach(category => {
            category.addEventListener('dragover', function (e) {
                e.preventDefault();
            });

            category.addEventListener('drop', function (e) {
                e.preventDefault();
                const taskId = e.dataTransfer.getData('task-id');
                const newStatus = this.dataset.status;

                const taskElement = document.querySelector(`.task-item[data-id="${taskId}"]`);
                this.querySelector('.space-y-4').appendChild(taskElement);

                updateTaskStatus(taskId, newStatus);
            });
        });
    }
    // update task
    function updateTaskStatus(taskId, newStatus) {
        fetch(`/tasks/${taskId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                status: newStatus
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(`Task ${taskId} updated to ${newStatus}`);
                } else {
                    console.error('Failed to update task status');
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
@endsection