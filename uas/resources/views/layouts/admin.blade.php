<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Admin Panel</title>
</head>
<body>
    <x-navbar :title="'Admin Panel'" :links="[
        ['label' => 'Home', 'url' => route('admin.home')],
        ['label' => 'To Do List', 'url' => route('admin.todo')],
        ['label' => 'Message', 'url' => route('admin.message')],
        ['label' => 'Calendar', 'url' => route('admin.calendar')],
        ['label' => 'Logout', 'url' => '#', 'onclick' => 'event.preventDefault(); document.getElementById(\'logout-form\').submit();']
    ]" />

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <div class="container mx-auto mt-6">
        @yield('content')
    </div>

    <script>
        document.querySelector('[href="#"]').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        });
    </script>
</body>
</html>
