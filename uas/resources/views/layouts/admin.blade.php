<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Admin Panel</title>
</head>
<body>
    <x-navbar :title="'Admin Panel'" :links="[
        ['label' => 'Homepage', 'url' => route('admin.home')],
        ['label' => 'To Do List', 'url' => route('admin.todo')],
        ['label' => 'Message', 'url' => route('admin.message')],
        ['label' => 'Calendar', 'url' => route('admin.calendar')]
    ]" />
    <div class="container mx-auto mt-6">
        @yield('content')
    </div>
</body>
</html>
