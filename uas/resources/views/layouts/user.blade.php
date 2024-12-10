<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>User Panel</title>
</head>
<body>
    <x-navbar :title="'User Panel'" :links="[
        ['label' => 'Home', 'url' => route('user.home')],
        ['label' => 'To Do List', 'url' => route('user.todo')],
        ['label' => 'Message', 'url' => route('user.message')],
        ['label' => 'Calendar', 'url' => route('user.calendar')],
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
