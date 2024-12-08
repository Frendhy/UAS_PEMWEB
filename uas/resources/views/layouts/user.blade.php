<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>User Panel</title>
</head>
<body>
    <x-navbar :title="'User Panel'" :links="[
        ['label' => 'Home', 'url' => route('user.home')],
        ['label' => 'To Do List', 'url' => route('user.todo')],
        ['label' => 'Message', 'url' => route('user.message')],
        ['label' => 'Calendar', 'url' => route('user.calendar')],
    ]" />
    <div class="container mx-auto mt-6">
        @yield('content')
    </div>
</body>
</html>
