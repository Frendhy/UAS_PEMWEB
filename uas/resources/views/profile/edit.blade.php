<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    @vite('resources/css/app.css')
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">


    <div class="w-full max-w-2xl p-6 bg-gray-200 rounded-md shadow-md border border-gray-300">
        <div>
            <?php
            $role_id = auth()->user()->role_id;
            $redirectRoute = $role_id === 1 ? route('admin.home') : route('user.home');
            ?>
            <a href="{{ $redirectRoute }}"
                class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Back
            </a>
            <h1 class="text-center text-2xl font-bold text-black mb-6">Edit Profile</h1>
        </div>
        <!-- Title -->

        <!-- Edit Form -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <input id="name" type="text" name="name" placeholder="Name"
                    class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required autofocus autocomplete="name" value="{{ old('name', $user->name) }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <input id="email" type="email" name="email" placeholder="Email"
                    class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required value="{{ old('email', $user->email) }}" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Divisi -->
            <div class="mb-4">
                <select id="division_id" name="division_id"
                    class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled {{ old('division_id', $user->division_id) ? '' : 'selected' }}>-- Select
                        Division --</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}" {{ old('division_id', $user->division_id) == $division->id ? 'selected' : '' }}>
                            {{ $division->divisi_name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('division_id')" class="mt-2" />
            </div>

            <!-- Birthday -->
            <div class="mb-4">
                <input id="birthday" type="date" name="birthday"
                    class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('birthday', $user->birthday) }}" />
                <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
            </div>

            <!-- Role -->
            <div class="mb-4">
                <select id="role_id" name="role_id"
                    class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="2" {{ old('role_id', $user->role_id) == 2 ? 'selected' : '' }}>Anggota</option>
                    <option value="1" {{ old('role_id', $user->role_id) == 1 ? 'selected' : '' }}>BPH / Koordinator
                    </option>
                </select>
                <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <input id="password" type="password" name="password" placeholder="Password (leave blank if unchanged)"
                    class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <input id="password_confirmation" type="password" name="password_confirmation"
                    placeholder="Confirm Password"
                    class="w-full px-4 py-2 text-sm border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-700 text-white py-2 px-4 rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Save Changes
                </button>


                <div class="text-right">
                    <a href="{{ route('password.change') }}" class="text-blue-600 hover:text-blue-800 underline">Ganti
                        Password?</a>
                    <br />

                    <!--<form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 underline">Logout</button>
                    </form> -->
                </div>
            </div>
        </form>

    </div>
</body>

</html>