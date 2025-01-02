@extends('layouts.user')

@section('content')
<div class="w-11/12 mx-auto mt-10">
    <!-- Header -->
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
        <div id="{{ $status }}-list" class="{{ $config['color'] }} rounded-lg shadow-lg p-6 task-category" data-status="{{ $status }}">
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
        <!-- Comment and Upload Modal -->
        @foreach ($tasks as $task)
        <div id="comment-upload-modal-{{ $task->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden comment-upload-modal">
            <div class="bg-white w-2/3 p-6 rounded-lg shadow-xl flex relative">
                <!-- Left Side: Task Details -->
                <div class="w-1/2 pr-4 border-r">
                    <h2 class="text-2xl font-semibold mb-4">Task Details</h2>
                    <p id="modal-status-{{ $task->id }}" class="text-gray-600 mb-2">Status: {{ $task->status }}</p>
                    <p id="modal-title-{{ $task->id }}" class="text-gray-800 font-semibold mb-2">Title: {{ $task->title }}</p>
                    <p id="modal-deadline-{{ $task->id }}" class="text-gray-600 mb-4">Deadline: {{ $task->deadline }}</p>
                </div>
                <!-- Right Side: Comment and Upload -->
                <div class="w-1/2 pl-4">
                    <!-- Form Section -->
                    <form id="comment-upload-form-{{ $task->id }}" method="POST" enctype="multipart/form-data" class="flex flex-col h-full">
                        @csrf
                        <!-- Chatbox Input -->
                        <div class="flex items-center bg-gray-100 border border-gray-300 rounded-lg p-4 space-x-4">
                            <!-- File Input -->
                            <label class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full cursor-pointer hover:bg-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16">
                                    <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z" />
                                </svg>
                                <input type="file" name="file" class="hidden" id="task-file-{{ $task->id }}">
                            </label>
                            <!-- Textarea -->
                            <textarea name="comment" class="flex-grow p-2 bg-transparent focus:outline-none resize-none" placeholder="Add a comment" rows="1"></textarea>
                            <!-- Submit Button -->
                            <button type="submit" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($comment->created_at)->timezone('Asia/Bangkok')->format('d M Y, H:i') }}</p>
                                </div>
                                <p class="text-gray-700 mb-2">{{ $comment->comment }}</p>
                                @if ($comment->file_path)
                                <a href="{{ asset('storage/' . $comment->file_path) }}" target="_blank" class="text-blue-500 hover:underline">📎 View Attachment</a>
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
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        initDragAndDrop();

        // Open Modal
        document.querySelectorAll('.task-item').forEach(item => {
            item.addEventListener('click', function() {
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
        // Close Modal on Outside Click
        document.querySelectorAll('.comment-upload-modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    });
    // Initialize drag-and-drop functionality (if required)
    function initDragAndDrop() {
        document.querySelectorAll('.task-item').forEach(task => {
            task.addEventListener('dragstart', function(e) {
                e.dataTransfer.setData('task-id', this.dataset.id);
            });
        });

        document.querySelectorAll('.task-category').forEach(category => {
            category.addEventListener('dragover', function(e) {
                e.preventDefault();
            });

            category.addEventListener('drop', function(e) {
                e.preventDefault();
                const taskId = e.dataTransfer.getData('task-id');
                const newStatus = this.dataset.status;

                const taskElement = document.querySelector(`.task-item[data-id="${taskId}"]`);
                this.querySelector('.space-y-4').appendChild(taskElement);

                updateTaskStatus(taskId, newStatus);
            });
        });
    }

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