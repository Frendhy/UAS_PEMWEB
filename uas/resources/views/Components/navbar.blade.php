<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <nav class="bg-gray-800 shadow">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="{{route('hmifpage')}}">
                    <img src="{{ asset('img/Logo-HMIF.png') }}" alt="logo" class="w-10 h-10">
                    </a>
                </div>
                <div class="hidden md:flex space-x-4">
                    @foreach ($links as $link)
                        <a href="{{ $link['url'] }}"
                            class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
                <div class="flex items-center">
                    <a href="{{ route('profile.edit') }}">
                        <div class="w-10 h-10 flex items-center justify-center text-xl text-white bg-gray-700 rounded-full cursor-pointer">
                            🏠
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>