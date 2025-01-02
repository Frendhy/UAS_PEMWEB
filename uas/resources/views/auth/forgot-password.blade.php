<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite('resources/css/app.css')
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">

    <div class="w-full max-w-md p-6 bg-gray-200 rounded-md shadow-md border border-gray-300">
        <!-- Title -->
        <h1 class="text-center text-2xl font-bold text-black mb-6">Forgot Password</h1>

        <p class="text-sm text-black-600 dark:text-black-400 mb-6 text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>

        <!-- Alert Message -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-700 bg-green-100 p-4 rounded-md">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <input id="email" 
                       type="email" 
                       name="email" 
                       placeholder="Enter your email" 
                       class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required 
                       autofocus 
                       value="{{ old('email') }}" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-blue-700 text-white py-2 text-center rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                {{ __('Email Password Reset Link') }}
            </button>
        </form>
    </div>

</body>

</html>
