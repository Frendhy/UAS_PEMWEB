<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">

    <div class="w-full max-w-md p-6 bg-gray-200 rounded-md shadow-md border border-gray-300">
        <!-- Title -->
        <h1 class="text-center text-2xl font-bold text-black mb-6">Login</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <input id="email" 
                       type="email" 
                       name="email" 
                       placeholder="Masukkan Email" 
                       class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required 
                       autofocus 
                       autocomplete="username"
                       value="{{ old('email') }}" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-2">
                <input id="password" 
                       type="password" 
                       name="password" 
                       placeholder="Masukkan Password" 
                       class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required 
                       autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Forgot Password Link -->
            <div class="text-right mb-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-700 hover:underline">Lupa Password?</a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit" 
                    class="w-full bg-blue-700 text-white py-2 text-center rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Login
            </button>
        </form>

    </div>

</body>

</html>
