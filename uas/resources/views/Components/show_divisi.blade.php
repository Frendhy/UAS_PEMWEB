<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Divisi</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body>
    <div class="container">

        @if ($id == 1)
        <div class="flex justify-around mt-8 space-x-4">
            <!-- Done Column -->
            <div class="bg-blue-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Done</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox" checked>
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 3</span>
                    <input type="checkbox">
                </div>
            </div>
            <!-- In Progress Column -->
            <div class="bg-orange-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">In Progress</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 3</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 4</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 5</span>
                    <input type="checkbox">
                </div>
            </div>
            <!-- Not Yet Column -->
            <div class="bg-red-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Not Yet</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
            </div>
        </div>

        @elseif ($id == 2)
        <div class="flex justify-around mt-8 space-x-4">
            <!-- Done Column -->
            <div class="bg-blue-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Done</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox" checked>
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 3</span>
                    <input type="checkbox">
                </div>
            </div>
            <!-- In Progress Column -->
            <div class="bg-orange-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">In Progress</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 3</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 4</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 5</span>
                    <input type="checkbox">
                </div>
            </div>
            <!-- Not Yet Column -->
            <div class="bg-red-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Not Yet</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
            </div>
        </div>

        @elseif ($id == 3)
        <div class="flex justify-around mt-8 space-x-4">
            <!-- Done Column -->
            <div class="bg-blue-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Done</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox" checked>
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 3</span>
                    <input type="checkbox">
                </div>
            </div>
            <!-- In Progress Column -->
            <div class="bg-orange-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">In Progress</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 3</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 4</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 5</span>
                    <input type="checkbox">
                </div>
            </div>
            <!-- Not Yet Column -->
            <div class="bg-red-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Not Yet</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
            </div>
        </div>

        @elseif ($id == 4)
             <div class="flex justify-around mt-8 space-x-4">
            <!-- Done Column -->
            <div class="bg-blue-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Done</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox" checked>
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 3</span>
                    <input type="checkbox">
                </div>
            </div>
            <!-- In Progress Column -->
            <div class="bg-orange-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">In Progress</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 3</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 4</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 5</span>
                    <input type="checkbox">
                </div>
            </div>
            <!-- Not Yet Column -->
            <div class="bg-red-600 p-4 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Not Yet</h2>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 1</span>
                    <input type="checkbox">
                </div>
                <div class="bg-white text-black p-2 mb-2 rounded flex items-center justify-between">
                    <span>Task 2</span>
                    <input type="checkbox">
                </div>
            </div>
        </div>

        @else
            <h2>Invalid Divisi</h2>
            <p>The requested divisi does not exist.</p>
        @endif
    </div>
</body>
</html>
