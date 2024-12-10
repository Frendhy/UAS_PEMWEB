@extends('layouts.user')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-11/12 mx-auto mt-10">
        <!-- Done Column -->
        <div class="bg-blue-500 rounded-lg shadow-lg p-6">
            <h2 class="text-white text-2xl font-semibold mb-6">✅ Done</h2>
            <div id="done-list" class="space-y-4">
                @foreach ($tasksGrouped['done'] ?? [] as $task)
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition task-item" data-title="{{ $task->title }}" data-status="Done">
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
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition task-item" data-title="{{ $task->title }}" data-status="In Progress">
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
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition task-item" data-title="{{ $task->title }}" data-status="Not Yet">
                        <h3 class="font-bold text-lg text-gray-800">{{ $task->title }}</h3>
                        <p class="text-gray-600">{{ $task->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Comment Modal -->
    <div id="comment-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white w-1/3 p-6 rounded-lg shadow-xl">
            <h2 class="text-2xl font-semibold mb-4 text-center">Submissions Status</h2>
            <p id="modal-status" class="text-gray-600 mb-2">Status: </p>
            <p id="modal-title" class="text-gray-800 font-semibold mb-4">Title: </p>
            <textarea class="w-full p-3 border border-gray-300 rounded-lg mb-4" placeholder="Add a comment" rows="4"></textarea>
            <div class="flex justify-end space-x-2">
                <button id="close-comment-modal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-all">Cancel</button>
                <button id="open-file-modal" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-all">Add Submissions</button>
            </div>
        </div>
    </div>

    <!-- File Upload Modal -->
    <div id="file-upload-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white w-1/3 p-6 rounded-lg shadow-xl">
            <h2 class="text-xl font-semibold mb-4">Upload File</h2>
            <p class="text-sm text-gray-500 mb-4">Choose only 1 file</p>
            <label class="block w-full border border-gray-300 rounded-lg p-4 text-center cursor-pointer bg-gray-100 hover:bg-gray-200">
                <span class="font-semibold text-gray-700">Select from Drive</span>
                <input type="file" class="hidden" id="task-file">
            </label>
            <div class="flex justify-end space-x-2">
                <button id="close-file-modal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-all">Cancel</button>
                <button id="add-file" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-all">Add</button>
            </div>
        </div>
    </div>

    <!-- Submissions Successful Modal -->
    <div id="submission-success-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white w-1/3 p-6 rounded-lg text-center shadow-xl">
            <p class="text-xl font-semibold mb-4">Submissions Successful!</p>
            <button id="close-success-modal" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition-all">Okay</button>
        </div>
    </div>

    <script>
    // Show Comment Modal
    document.querySelectorAll('.task-item').forEach(item => {
        item.addEventListener('click', function() {
            const title = this.dataset.title;
            const status = this.dataset.status;

            // Populate modal content
            document.getElementById('modal-title').innerText = `Title: ${title}`;
            document.getElementById('modal-status').innerText = `Status: ${status}`;

            // Show modal
            document.getElementById('comment-modal').classList.remove('hidden');
        });
    });

    // Close Comment Modal
    document.getElementById('close-comment-modal').addEventListener('click', function() {
        document.getElementById('comment-modal').classList.add('hidden');
    });

    // Open File Upload Modal
    document.getElementById('open-file-modal').addEventListener('click', function() {
        document.getElementById('comment-modal').classList.add('hidden');
        document.getElementById('file-upload-modal').classList.remove('hidden');
    });

    // Close File Upload Modal
    document.getElementById('close-file-modal').addEventListener('click', function() {
        document.getElementById('file-upload-modal').classList.add('hidden');
    });

    // Handle File Upload
    document.getElementById('add-file').addEventListener('click', function() {
        // Hide all modals first
        document.getElementById('comment-modal').classList.add('hidden');
        document.getElementById('file-upload-modal').classList.add('hidden');

        // Show success modal
        document.getElementById('submission-success-modal').classList.remove('hidden');
    });

    // Close Submission Success Modal
    document.getElementById('close-success-modal').addEventListener('click', function() {
        document.getElementById('submission-success-modal').classList.add('hidden');
    });
</script>

@endsection
