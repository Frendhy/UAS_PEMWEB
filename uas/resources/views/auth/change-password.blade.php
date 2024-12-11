<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    @vite('resources/css/app.css')
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">

    <div class="w-full max-w-md p-6 bg-gray-200 rounded-md shadow-md border border-gray-300">
        <!-- Title -->
        <h1 class="text-center text-2xl font-bold text-black mb-6">Change Password</h1>

        <!-- Change Password Form -->
        <form method="POST" action="{{ route('password.change') }}">
            @csrf

            <!-- Old Password -->
            <div class="mb-4">
                <input id="old_password" 
                       type="password" 
                       name="old_password" 
                       placeholder="Old Password" 
                       class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required 
                       autocomplete="current-password" />
                <x-input-error :messages="$errors->get('old_password')" class="mt-2" />
            </div>

            <!-- New Password -->
            <div class="mb-4">
                <input id="new_password" 
                       type="password" 
                       name="new_password" 
                       placeholder="New Password" 
                       class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required 
                       autocomplete="new-password" />
                <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
            </div>

            <!-- Confirm New Password -->
            <div class="mb-4">
                <input id="new_password_confirmation" 
                       type="password" 
                       name="new_password_confirmation" 
                       placeholder="Confirm New Password" 
                       class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required 
                       autocomplete="new-password" />
                <x-input-error :messages="$errors->get('new_password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-blue-700 text-white py-2 text-center rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Change Password
            </button>
        </form>

    </div>

</body>

</html>